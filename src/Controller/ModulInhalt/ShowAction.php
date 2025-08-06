<?php

namespace App\Controller\ModulInhalt;

use App\Entity\ModulInhalt;
use App\Repository\KompetenzBereichRepositoryInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowAction extends AbstractController {

    #[Route('/modulinhalt/{id}', name: 'show_modulinhalt')]
    public function __invoke(#[MapEntity] ModulInhalt $modulInhalt, KompetenzBereichRepositoryInterface $kompetenzBereichRepository): Response {
        return $this->render('modul_inhalt/show.html.twig', [
            'modulInhalt' => $modulInhalt,
            'bereiche' => $kompetenzBereichRepository->findAll(),
        ]);
    }
}