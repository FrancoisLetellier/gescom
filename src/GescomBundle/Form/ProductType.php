<?php

namespace GescomBundle\Form;

use GescomBundle\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
            // we defined explicitely a FormType as parameter
            ->add('productSupplier', SupplierListType::class, ['label' => 'Fournisseur'])
            ->add('submit', SubmitType::class, ['label' => 'Ajouter'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class,
        ));
    }
    public function getBlockPrefix()
    {
        return 'gescom_bundle_product_type';
    }
}