<?php

namespace GescomBundle\Form\Supplier;

use GescomBundle\Entity\Product;
use GescomBundle\Entity\Supplier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SupplierDeleteType
 * @package GescomBundle\Form\Supplier
 */
class SupplierDeleteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('submit', SubmitType::class, ['label' => 'Supprimer le fournisseur'])
            ->getForm();
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Supplier::class,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'gescom_bundle_supplierDelete_type';
    }
}