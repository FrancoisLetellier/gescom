<?php

namespace GescomBundle\Form\Supplier;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SupplierListType
 * @package GescomBundle\Form\Supplier
 */
class SupplierListType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add a select for supplier name to integrate into product
        // The selector is built through the provider entity in which the vendor name is stored
        $builder
            ->add('name', EntityType::class, [
                'class'         => 'GescomBundle\Entity\Supplier',
                'choice_label'  => 'name',
                'label' => 'Nom',
                //  We want to be able to select several suppliers
                'multiple'      => true,
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'gescom_bundle_supplierList_type';
    }

}