<?php

namespace App\Form;

use App\Entity\Tasks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateTask', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'html5' => true,
                'label' => "Date et Heure de la tache",
                'attr' => [
                    'class' => 'text-center',
                    'style' => 'width: 350px',
                ]
            ])
            ->add('description', TextType::class,[
                'attr' => [
                    'class' => 'text-center',
                    'style' => 'width: 350px',
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'À faire' => 1,
                    'En cours' => 2,
                    'Terminée' => 3,
                    'Archivée' => 4,
                ],
                'label' => 'Statut',
                'label_attr' =>[
                    'class' => 'text-center',
                ],
                'attr' => [
                    'class' => 'text-center',
                    'style' => 'width: 350px',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tasks::class,
        ]);
    }
}
