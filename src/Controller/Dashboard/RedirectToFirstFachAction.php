<?php

namespace App\Controller\Dashboard;

use App\Repository\FachRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectToFirstFachAction extends AbstractController {
    #[Route('/fach', name: 'fach_redirect')]
    public function __invoke(FachRepositoryInterface $fachRepository): RedirectResponse|Response {
        $faecher = $fachRepository->findAll();
        if(count($faecher) === 0) {
            return $this->render('dashboard/empty.html.twig');
        }

        $first = reset($faecher);
        return $this->redirectToRoute('fach', [
            'id' => $first->getId()
        ]);
    }
}