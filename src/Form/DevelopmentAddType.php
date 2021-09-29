<?php

namespace App\Form;

use App\Entity\Development\Development;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevelopmentAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('slug')
            ->add('filename')
            ->add('section')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Development::class,
        ]);
    }
}
