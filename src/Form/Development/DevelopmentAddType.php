<?php

namespace App\Form\Development;

use App\Entity\Development\Development;
use App\Entity\Development\Section;
use App\Entity\Development\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class DevelopmentAddType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Enter a title'
                ]
            ])
            ->add('slug', TextType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Enter the slug'
                ]
            ])
            ->add('content', CKEditorType::class, [
                    'config' => [
                        'uiColor' => '#ffffff'
                    ],
                    'label'  => false
                ]
            )
            ->add('file', FileType::class, [
                'required'    => false,
                'label'       => false,
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
            ->add('section', EntityType::class, [
                'label'              => false,
                'placeholder'        => 'Select a section',
                'class'              => Section::class
            ])
            ->add('tags', CustomSelectEntityType::class, [
                'class' => Tag::class,
                'label' => false
            ])
            ->add('posts', CollectionType::class, [
                'label'          => 'Posts',
                'entry_type'     => PostType::class,
                'prototype'      => true,
                'allow_add'      => true,
                'allow_delete'   => true,
                'by_reference'   => false,
                'required'       => false,
                'disabled'       => false,
                'error_bubbling' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Save'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Development::class,
        ]);
    }
}
