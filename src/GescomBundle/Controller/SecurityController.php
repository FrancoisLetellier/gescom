<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\User;
use GescomBundle\Entity\UserProfile;
use GescomBundle\Form\User\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\SecurityBundle\Tests\Functional\Bundle\CsrfFormLoginBundle\Form\UserLoginType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class SecurityController
 * @package GescomBundle\Controller
 * @Route("/mon-compte", name="userHome")
 */
class SecurityController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="userArea")
     */
    public function indexAction()
    {
        return $this->render('GescomBundle:Pages/User:user_account.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/inscription", name="register")
     */
    public function addAction(Request $request)
    {
        /**
         * USER can't come to register page
         * We check if auth has role ROLE_USER
         * if is ok, redirect to account section
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('userArea');
        }

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            /**
             * Here we get the encoderType
             * location #app/config/security.yml
             */
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setSalt('');
            $user->setPassword($password);
            $user->setEmail($user->getUsername());

            $userProfile = new UserProfile();

            $user->setRoles(array('ROLE_USER'));
            $user->setProfile($userProfile);
            $user->setEmail($user->getUsername());

            $userProfile->setUsername(mt_rand(1, 10000).'test');
            $userProfile->setAvatar('assets/img/avatar.png');
            $userProfile->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($userProfile);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('userArea');
        }

        return $this->render('GescomBundle:Pages/User:user_add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/connexion", name="login")
     */
    public function loginAction(Request $request)
    {
        /**
         * USER can't come to login page
         * We check if auth has role ROLE_USER
         * if is ok, redirect to account section
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('userArea');
        }

        /**
         * Get the login error if there is one
         * Get the last username entered by user
         */
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@Gescom/Pages/User/user_connect.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

}