<?php

namespace App\Form\Development;

use App\Entity\Development\Development;
use App\Entity\Development\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class DevelopmentAddType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('slug')
            ->add('file', FileType::class, [
                'label'       => 'Thumb',
                'constraints' => [
                    new File([
                        'maxSize'          => '5M',
                        'mimeTypes'        => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ]
            ])
            ->add('section')
            ->add('tags', CustomSelectEntityType::class, [
                'class' => Tag::class
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Development::class,
        ]);
    }
}