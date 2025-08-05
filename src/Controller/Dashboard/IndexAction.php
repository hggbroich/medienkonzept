<?php

namespace App\Controller\Dashboard;

use App\Repository\JahrgangsstufeRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexAction extends AbstractController {
    #[Route('')]
    #[Route('/', name: 'dashboard')]
    #[Route('/jahrgangsstufe', name: 'jgst_redirect')]
    public function __invoke(JahrgangsstufeRepositoryInterface $jahrgangsstufeRepository): RedirectResponse|Response {
        $jgst = $jahrgangsstufeRepository->findAll();
        if(count($jgst) === 0) {
            return $this->render('dashboard/empty.html.twig');
        }

        $first = reset($jgst);
        return $this->redirectToRoute('jgst', [
            'id' => $first->getId()
        ]);
    }
}