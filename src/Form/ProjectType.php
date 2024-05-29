<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('url', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('date', DateType::class, [
                // 'widget' => 'single_text', // Affiche le champ de date comme un champ de texte simple
                'format' => 'dd-MM-yyyy', // Format de la date
                'html5' => false, // Désactive les types de champs HTML5 natifs pour le champ de date
                'required' => false, 
                'attr' => ['class' => 'form-control datepicker'], // Ajoutez des classes CSS pour la stylisation
            ])
            ->add('creer', SubmitType::class, [
                'label' => isset($options["label"]) ? $options["label"] : "ADD",
                'attr' => ['class' => 'newProjectBtn mt-4']
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
