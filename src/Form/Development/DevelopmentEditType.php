<?php

namespace App\Form\Development;

use App\Entity\Development\Development;
use App\Entity\Development\Tag;
use App\Form\Development\SearchableEntityType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DevelopmentEditType extends AbstractType
{

    public function __construct(private UrlGeneratorInterface $url)
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', CKEditorType::class, [
                'config' => [
                    'uiColor' => '#ffffff'
                ],
                'label'  => false
            ])
            ->add('slug')
            ->add('file', FileType::class, [
                'label'    => false,
                'required' => false,
                'attr'     => ['placeholder' => $options['data']->getFileName()]
            ])
            ->add('section')
            ->add('tags', SearchableEntityType::class, [
                'class'          => Tag::class,
                'search'         => $this->url->generate('api_tag_development'),
                'label_property' => 'name'
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
