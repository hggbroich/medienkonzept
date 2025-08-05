<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;

#[AsCommand(name: 'app:setup', description: 'Installiert die Anwendung.')]
readonly class SetupCommand {

    public function __construct(private EntityManagerInterface $em, private PdoSessionHandler $pdoSessionHandler) { }

    public function __invoke(SymfonyStyle $style): int {
        $this->setupSessions($style);

        return Command::SUCCESS;
    }

    private function setupSessions(SymfonyStyle $style): void {
        $sql = "SHOW TABLES LIKE 'sessions';";
        $row = $this->em->getConnection()->executeQuery($sql);

        if($row->fetchOne() === false) {
            $this->pdoSessionHandler->createTable();
        }

        $style->success('Sessions table ready.');
    }
}