<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class , [
                'attr'=> array(
                    'class' => 'bg-gray-300 border border-gray-300 text-gray-500 text-sm  block w-full p-2.5 outline-none'
                ),
                'label' => "Intitule",
                'required' => true
            ])
            ->add('region', ChoiceType::class, [
                'attr' => [
                    'class' => 'bg-gray-300 border border-gray-300 text-gray-500 text-sm  block w-full p-2.5 outline-none',
                ],
                'required' => true,
                'choices' => [
                    'Region 1' => 'Region 1',
                    'Region 2' => 'Region 2',
                ],
                'placeholder' => 'Select Region',
            ])
            ->add('province', ChoiceType::class, [
                'attr' => [
                    'class' => 'bg-gray-300 border border-gray-300 text-gray-500 text-sm  block w-full p-2.5 outline-none',
                ],
                'choices' => [
                    'Province 1.1' => 'Province 1.1',
                    'Province 1.2' => 'Province 1.2',
                    'Province 2.1' => 'Province 2.1',
                    'Province 2.2' => 'Province 2.2',
                ],
                'required' => true,
                'placeholder' => 'Select Province',
            ])
            ->add('commune', ChoiceType::class, [
                'attr' => [
                    'class' => 'bg-gray-300 border border-gray-300 text-gray-500 text-sm  block w-full p-2.5 outline-none',
                ],
                'choices' => [
                    'Commune 1.1.1' => 'Commune 1.1.1',
                    'Commune 1.1.2' => 'Commune 1.1.2',
                    'Commune 1.2.1' => 'Commune 1.2.1',
                    'Commune 1.2.2' => 'Commune 1.2.2',
                    'Commune 2.1.1' => 'Commune 2.1.1',
                    'Commune 2.1.2' => 'Commune 2.1.2',
                    'Commune 2.2.1' => 'Commune 2.2.1',
                    'Commune 2.2.2' => 'Commune 2.2.2',
                ],
                'required' => true,
                'placeholder' => 'Select Commune',
            ])

            ->add('surfaceArea', NumberType::class,  [
                'attr'=> array(
                    'class' => 'bg-gray-300 border border-gray-300 text-gray-500 text-sm  block w-full p-2.5 outline-none'
                ),
                'label' => "Superficie",
                'required' => true
            ])
            ->add('nbrApplications', NumberType::class,  [
                'attr'=> array(
                    'class' => 'bg-gray-300 border border-gray-300 text-gray-500 text-sm  block w-full p-2.5 outline-none'
                ),
                'label' => "Nombre de postulation",
                'required' => true
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}

