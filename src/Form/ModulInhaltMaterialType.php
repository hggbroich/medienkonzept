<?php

namespace App\Form;

use App\Entity\Material;
use App\Entity\ModulInhaltMaterial;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModulInhaltMaterialType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('material', EntityType::class, [
                'class' => Material::class,
                'label' => 'Material',
                'choice_label' => 'bezeichnung'
            ])
            ->add('detail', TextType::class, [
                'required' => false,
                'label' => 'Details'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefault('data_class', ModulInhaltMaterial::class);
    }
}