<?php

namespace App\Command;

use App\Entity\Fach;
use App\Entity\Jahrgang;
use App\Entity\Jahrgangsstufe;
use App\Entity\Kompetenz;
use App\Entity\Kompetenzbereich;
use App\Entity\Lerneinheit;
use App\Entity\LerneinheitArt;
use App\Entity\LerneinheitFunktion;
use App\Entity\Material;
use App\Entity\MaterialArt;
use App\Entity\MaterialVerfuegbarkeit;
use App\Entity\Modul;
use App\Entity\ModulInhalt;
use App\Entity\ModulInhaltMaterial;
use App\Entity\ModulKompetenzstufe;
use App\Entity\Werkzeug;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Attribute\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('app:import', description: 'Import Daten aus einer vorhanden MDB (schulintern zum Import)')]
class ImportCommand {

    /** @var array<int, Fach> */
    private array $faecherMap = [ ];
    /** @var array<int, Jahrgangsstufe> */
    private array $jahrgangsstufenMap = [ ];
    /** @var array<int, Kompetenzbereich> */
    private array $kompetenzBereichMap = [ ];
    /** @var array<int, Kompetenz> */
    private array $kompetenzMap = [ ];
    /** @var array<int, LerneinheitArt> */
    private array $lerneinheitArtenMap = [ ];
    /** @var array<int, LerneinheitFunktion> */
    private array $lerneinheitFunktionenMap = [ ];
    /** @var array<int, Lerneinheit> */
    private array $lerneinheitenMap = [ ];
    /** @var array<int, Material> */
    private array $materialMap = [ ];
    /** @var array<int, Werkzeug> */
    private array $werkzeugeMap = [ ];
    /** @var array<int, Modul> */
    private array $moduleMap = [ ];
    /** @var array<int, ModulKompetenzstufe> */
    private array $modulKompetenzstufenMap = [ ];
    /** @var array<int, ModulInhalt> */
    private array $modulInhalteMap = [ ];

    public function __construct(private readonly EntityManagerInterface $em) { }

    public function __invoke(#[Option(description: 'Pfad zum Ordner mit den JSON-Dateien aus der Access DB', name: 'path', shortcut: 'p')] string $path): int {
        $this->importFaecher($path);
        $this->importJahrgaenge($path);
        $this->importKompetenzbereiche($path);
        $this->importKompetenzen($path);
        $this->importLerneinheitenArten($path);
        $this->importLerneinheitenFunktionen($path);
        $this->importLerneinheiten($path);
        $this->importLerneinheitenJahrgangsstufen($path);
        $this->importMaterial($path);
        $this->importWerkzeuge($path);
        $this->importModule($path);
        $this->importModulkompetenzstufen($path);
        $this->importModulInhalte($path);
        $this->importModulinhalteKompetenzen($path);
        $this->importModulinhalteLerneinheiten($path);
        $this->importModulinhalteMaterialien($path);
        $this->importModulinhalteWerkzeuge($path);

        return Command::SUCCESS;
    }

    private function importFaecher(string $path): void {
        foreach($this->getJsonLines($path, 'tblFaecher.json') as $fach) {
            $entity = (new Fach())->setKuerzel($fach->Kuerzel)->setBezeichnung($fach->Bezeichnung);
            $this->faecherMap[$fach->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importJahrgaenge(string $path): void {
        $jahrgaenge = [ ];

        foreach($this->getJsonLines($path, 'tblJahrgangsstufen.json') as $line) {
            if(!property_exists($line, 'Jahrgang') || in_array($line->Jahrgang, $jahrgaenge)) {
                continue;
            }

            $this->em->persist((new Jahrgang())->setBezeichnung($line->Jahrgang));
            $jahrgaenge[] = $line->Jahrgang;
        }

        $this->em->flush();

        foreach($this->getJsonLines($path, 'tblJahrgangsstufen.json') as $line) {
            if(!property_exists($line, 'Jahrgang')) {
                $entity = (new Jahrgangsstufe())->setBezeichnung($line->Bezeichnung);
            } else {
                $jahrgang = $this->em->getRepository(Jahrgang::class)->findOneBy(['bezeichnung' => $line->Jahrgang]);
                $entity = (new Jahrgangsstufe())->setBezeichnung($line->Bezeichnung)->setJahrgang($jahrgang)->setHalbjahr($line->Halbjahr);
            }

            $this->jahrgangsstufenMap[$line->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importKompetenzbereiche(string $path): void {
        foreach($this->getJsonLines($path, 'tblKatalogMedienPassNRWKompetenzbereiche.json') as $bereich) {
            $entity = (new Kompetenzbereich())->setBezeichnung($bereich->Bezeichnung)->setLaufendeNummer($bereich->LfdNr);
            $this->kompetenzBereichMap[$bereich->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importKompetenzen(string $path): void {
        foreach($this->getJsonLines($path, 'tblKatalogMedienPassNRWKompetenzen.json') as $kompetenz) {
            $bereich = $this->kompetenzBereichMap[$kompetenz->MedienPassNRWKompetenzbereichID];
            $entity = (new Kompetenz())->setKompetenzbereich($bereich)->setBezeichnung($kompetenz->Bezeichnung)->setBeschreibung($kompetenz->Beschreibung)->setLaufendeNummer($kompetenz->LfdNr);
            $this->kompetenzMap[$kompetenz->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importLerneinheitenArten(string $path): void {
        foreach($this->getJsonLines($path, 'tblLerneinheitArten.json') as $art) {
            $entity = (new LerneinheitArt())->setBezeichnung($art->Bezeichnung);
            $this->lerneinheitArtenMap[$art->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importLerneinheitenFunktionen(string $path): void {
        foreach($this->getJsonLines($path, 'tblLerneinheitFunktionen.json') as $funktion) {
            $entity = (new LerneinheitFunktion())->setBezeichnung($funktion->Bezeichnung);
            $this->lerneinheitFunktionenMap[$funktion->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importLerneinheiten(string $path): void {
        foreach($this->getJsonLines($path, 'tblLerneinheiten.json') as $einheit) {
            $funktion = reset($this->lerneinheitFunktionenMap);

            if(property_exists($einheit, 'FunktionID')) {
                $funktion = $this->lerneinheitFunktionenMap[$einheit->FunktionID];
            }

            if(!property_exists($einheit, 'Bezeichnung')) {
                continue;
            }

            $entity = (new Lerneinheit())
                ->setArt($this->lerneinheitArtenMap[$einheit->ArtID])
                ->setFach($this->faecherMap[$einheit->FachID])
                ->setFunktion($funktion)
                ->setBezeichnung($einheit->Bezeichnung)
                ->setStundenumfang($einheit->Stundenumfang);
            $this->lerneinheitenMap[$einheit->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importLerneinheitenJahrgangsstufen(string $path): void {
        foreach($this->getJsonLines($path, 'tblLerneinheitJahrgangsstufen.json') as $line) {
            if(!isset($this->lerneinheitenMap[$line->LerneinheitID])) {
                continue;
            }

            /** @var Lerneinheit $lerneinheit */
            $lerneinheit = $this->lerneinheitenMap[$line->LerneinheitID];


            $lerneinheit->addJahrgangsstufe($this->jahrgangsstufenMap[$line->JahrgangsstufeID]);

            $this->em->persist($lerneinheit);
        }

        $this->em->flush();
    }

    private function importMaterial(string $path): void {
        $verfuegbarkeiten = [ ];
        $arten = [ ];
        foreach($this->getJsonLines($path, 'tblMaterial.json') as $material) {
            if(property_exists($material, 'Verfügbarkeit')) {
                $verfuegbarkeit = $material->{'Verfügbarkeit'};
                if (!array_key_exists($verfuegbarkeit, $verfuegbarkeiten) && !empty($verfuegbarkeit)) {
                    $verfuegbarkeiten[$verfuegbarkeit] = (new MaterialVerfuegbarkeit())->setBezeichnung($verfuegbarkeit);
                    $this->em->persist($verfuegbarkeiten[$verfuegbarkeit]);
                }
            }
            if(property_exists($material, 'Medien-Art')) {
                $art = $material->{'Medien-Art'};
                if (!array_key_exists($art, $arten) && !empty($art)) {
                    $arten[$art] = (new MaterialArt())->setBezeichnung($art);
                    $this->em->persist($arten[$art]);
                }
            }
        }

        $this->em->flush();

        foreach($this->getJsonLines($path, 'tblMaterial.json') as $material) {
            $verfuegbarkeit = null;
            $art = null;

            if(property_exists($material, 'Verfügbarkeit') && isset($verfuegbarkeiten[$material->{'Verfügbarkeit'}])) {
                $verfuegbarkeit = $verfuegbarkeiten[$material->{'Verfügbarkeit'}];
            }

            if(property_exists($material, 'Medien-Art') && isset($arten[$material->{'Medien-Art'}])) {
                $art = $arten[$material->{'Medien-Art'}];
            }

            $entity = (new Material())
                ->setBezeichnung($material->Bezeichnung)
                ->setQuelle($material->Quelle)
                ->setArt($art)
                ->setVerfuegbarkeit($verfuegbarkeit);
            $this->materialMap[$material->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importWerkzeuge(string $path): void {
        foreach($this->getJsonLines($path, 'tblWerkzeuge.json') as $werkzeug) {
            $entity = (new Werkzeug())
                ->setBezeichnung($werkzeug->Bezeichnung);

            if(property_exists($werkzeug, 'Typ')) {
                $entity->setBeschreibung($werkzeug->Typ);
            }

            $this->werkzeugeMap[$werkzeug->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importModule(string $path): void {
        foreach($this->getJsonLines($path, 'tblModule.json') as $modul) {
            $entity = (new Modul())
                ->setBezeichnung($modul->Bezeichnung);

            $this->moduleMap[$modul->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importModulkompetenzstufen(string $path): void {
        foreach($this->getJsonLines($path, 'tblModulKompetenzstufen.json') as $stufe) {
            $entity = (new ModulKompetenzstufe())
                ->setBezeichnung($stufe->Bezeichnung)
                ->setSortierung($stufe->Sortierung);
            $this->modulKompetenzstufenMap[$stufe->ID] = $entity;
            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importModulInhalte(string $path): void {
        foreach($this->getJsonLines($path, 'tblModulInhalte.json') as $inhalt) {
            if(!property_exists($inhalt,  'ModulKompetenzID')) {
                continue;
            }

            $modul = $this->moduleMap[$inhalt->ModulID];
            $kompetenz = $this->modulKompetenzstufenMap[$inhalt->ModulKompetenzID];

            $entity = (new ModulInhalt())
                ->setBezeichnung($inhalt->Zusammenfassung)
                ->setZusammenfassung($inhalt->Beschreibung)
                ->setModul($modul)
                ->setKompetenzstufe($kompetenz);

            $this->modulInhalteMap[$inhalt->ID] = $entity;

            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    private function importModulinhalteLerneinheiten(string $path): void {
        foreach($this->getJsonLines($path, 'tblModulInhalteLerneinheiten.json') as $line) {
            /** @var ModulInhalt|null $inhalt */
            $inhalt = $this->modulInhalteMap[$line->ModulInhaltID] ?? null;
            /** @var Lerneinheit|null $lerneinheit */
            $lerneinheit = $this->lerneinheitenMap[$line->LerneinheitID] ?? null;

            if($inhalt == null || $lerneinheit == null) {
                continue;
            }

            $inhalt->getLerneinheiten()->add($lerneinheit);

            $this->em->persist($inhalt);
        }

        $this->em->flush();
    }

    private function importModulinhalteKompetenzen(string $path): void {
        foreach($this->getJsonLines($path, 'tblModulInhalteMedienPassNRW.json') as $line) {
            /** @var ModulInhalt|null $inhalt */
            $inhalt = $this->modulInhalteMap[$line->ModulInhaltID] ?? null;
            /** @var Kompetenz|null $kompetenz */
            $kompetenz = $this->kompetenzMap[$line->MedienPassNRWKompetenzID] ?? null;

            if($inhalt == null || $kompetenz == null) {
                continue;
            }

            $inhalt->getKompetenzen()->add($kompetenz);
            $this->em->persist($inhalt);
        }

        $this->em->flush();
    }

    private function importModulinhalteWerkzeuge(string $path): void {
        foreach($this->getJsonLines($path, 'tblModulInhaltWerkzeuge.json') as $line) {
            /** @var ModulInhalt|null $inhalt */
            $inhalt = $this->modulInhalteMap[$line->ModulInhaltID] ?? null;
            /** @var Werkzeug|null $werkzeug */
            $werkzeug = $this->werkzeugeMap[$line->WerkzeugID] ?? null;

            if($inhalt == null || $werkzeug == null) {
                continue;
            }

            $inhalt->getWerkzeuge()->add($werkzeug);
            $this->em->persist($inhalt);
        }

        $this->em->flush();
    }

    private function importModulinhalteMaterialien(string $path): void {
        foreach($this->getJsonLines($path, 'tblModulInhaltMaterialien.json') as $line) {
            /** @var ModulInhalt|null $inhalt */
            $inhalt = $this->modulInhalteMap[$line->ModulInhaltID] ?? null;
            /** @var Material|null $material */
            $material = $this->materialMap[$line->MaterialID] ?? null;

            if($inhalt == null || $material == null) {
                continue;
            }

            $inhaltMaterial = (new ModulInhaltMaterial())
                ->setInhalt($inhalt)
                ->setMaterial($material);

            if(property_exists($line, 'MaterialDetail')) {
                $inhaltMaterial->setDetail($line->MaterialDetail);
            }

            $this->em->persist($inhaltMaterial);
            $inhalt->getMaterialien()->add($inhaltMaterial);
            $this->em->persist($inhalt);
        }

        $this->em->flush();
    }

    /**
     * @param string $path
     * @param string $filename
     * @return iterable<stdClass>
     */
    private function getJsonLines(string $path, string $filename): iterable {
        $handle = fopen($path . DIRECTORY_SEPARATOR . $filename, 'r');

        while(($line = fgets($handle)) !== false) {
            yield json_decode($line);
        }

        fclose($handle);
    }
}