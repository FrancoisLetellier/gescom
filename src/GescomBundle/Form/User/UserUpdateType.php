<?php
namespace GescomBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserUpdateType
 * @package GescomBundle\Form
 */
class UserUpdateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', PasswordType::class);
        $builder->add('newPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe doivent correspondre.',
            'required' => true,
            'first_options'  => array('label' => 'nouveau mot de passe'),
            'second_options' => array('label' => 'Confirmation du mot de passe'),
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ChangePassword::class,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'gescom_bundle_user_type';
    }

}