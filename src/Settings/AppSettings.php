<?php

namespace App\Settings;

use Jbtronics\SettingsBundle\ParameterTypes\StringType;
use Jbtronics\SettingsBundle\Settings\Settings;
use Jbtronics\SettingsBundle\Settings\SettingsParameter;
use Jbtronics\SettingsBundle\Settings\SettingsTrait;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

#[Settings]
class AppSettings {
    use SettingsTrait;

    #[SettingsParameter(type: StringType::class, label: 'settings.app.custom_css.label', description: 'settings.app.custom_css.help', formType: TextareaType::class, formOptions: [ 'required' => false, 'attr' => ['rows'=> 30, 'class' => 'font-monospace']], nullable: true)]
    public ?string $customCss = null;
}