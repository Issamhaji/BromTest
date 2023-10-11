<?php

namespace App\Form;

use App\Entity\Deliverables;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class DeliverableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('deliverable1File', VichFileType::class , [
                'attr'=> array(
                    'id' => 'foo',
                    'class' => 'block w-full mt-5 text-sm text-gray-500 bg-gray-300
                                file:mr-4 file:py-2 file:px-4
                                file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-500 file:text-white
                                hover:file:bg-blue-600
                               '
                ),
                'label' => "Livrable 01",
                'required' => true
            ])
            ->add('deliverable2File',  VichFileType::class , [
                'attr'=> array(
                    'id' => 'foo',
                    'class' => 'block w-full mt-5 text-sm text-gray-500 bg-gray-300
                                file:mr-4 file:py-2 file:px-4
                                file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-500 file:text-white
                                hover:file:bg-blue-600
                               '
                ),
                'label' => "Livrable 02",
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deliverables::class,
        ]);
    }
}
