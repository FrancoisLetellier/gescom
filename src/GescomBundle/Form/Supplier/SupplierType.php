<?php

namespace GescomBundle\Form\Supplier;

use GescomBundle\Entity\Supplier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SupplierType
 * @package GescomBundle\Form\Supplier
 */
class SupplierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du fournisseur'])
            ->add('address', TextType::class, ['label' => 'Adresse'])
            ->add('postalCode', TextType::class, ['label' => 'Code postal'])
            ->add('town', TextType::class, ['label' => 'Ville'])
            ->add('siret', TextType::class, ['label' => 'SIRET'])
            ->add('email', TextType::class, ['label' => 'Email'])
            ->add('webUrl', TextType::class, ['label' => 'Site Web'])
            ->add('deliveryTime', TextType::class, ['label' => 'Délai de livraison'])
            ->add('note', TextType::class, ['label' => 'Note'])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer']);
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
        return 'gescom_bundle_supplier_type';
    }
}