<?php
namespace GescomBundle\Form\User;

use GescomBundle\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserProfileType
 * @package GescomBundle\Form
 */
class UserProfileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Nom d\'utilisateur'])
            ->add('avatar', TextType::class, ['label' => 'Avatar'])
            ->add('gender', ChoiceType::class, array(
                'choices'  => array(
                    '' => null,
                    'Femme' => 'f',
                    'Homme' => 'h',
                ), 'label' => 'Sexe'))
            ->add('age', IntegerType::class, ['label' => 'Age'])

            ->add('submit', SubmitType::class, ['label' => 'Enregistrer mon profile'])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserProfile::class,
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