<?php

namespace App\Controller\Settings;

use App\Settings\AppSettings;
use Jbtronics\SettingsBundle\Form\SettingsFormFactoryInterface;
use Jbtronics\SettingsBundle\Manager\SettingsManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppSettingsAction extends AbstractController {
    public function __construct(private readonly SettingsManagerInterface $settingsManager,
                                private readonly SettingsFormFactoryInterface $settingsFormFactory) {

    }

    #[Route('/settings/app', name: 'app_settings')]
    public function __invoke(Request $request): RedirectResponse|Response {
        $clone = $this->settingsManager->createTemporaryCopy(AppSettings::class);
        $builder = $this->settingsFormFactory->createSettingsFormBuilder($clone);
        $form = $builder->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->settingsManager->mergeTemporaryCopy($clone);
            $this->settingsManager->save();

            $this->addFlash('success', 'settings.success');

            return $this->redirectToRoute('app_settings');
        }

        return $this->render('settings/app.html.twig', [
            'form' => $form->createView()
        ]);
    }
}