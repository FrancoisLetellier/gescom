<?php

namespace GescomBundle\Form\Category;

use GescomBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CategoryType
 * @package GescomBundle\Form\Category
 */
class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom de la catégorie'])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr'  => [
                    'rows'  => '5',
                ],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Category::class,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'gescom_bundle_category_type';
    }
}