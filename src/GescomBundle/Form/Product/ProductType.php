<?php

namespace GescomBundle\Form\Product;

use GescomBundle\Entity\Product;
use GescomBundle\Form\Category\CategoryType;
use GescomBundle\Form\Supplier\SupplierListType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductType
 * @package GescomBundle\Form\Product
 */
class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du produit'])
            ->add('description', TextType::class, ['label' => 'Description'])
            //SF automatically retrieves correct data through doctrine links
            ->add('category')
            ->add('brand')
            // we defined explicitely a FormType as parameter
            ->add('productSupplier', SupplierListType::class, ['label' => 'Fournisseur'])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])
            ->getForm();
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'gescom_bundle_product_type';
    }

}