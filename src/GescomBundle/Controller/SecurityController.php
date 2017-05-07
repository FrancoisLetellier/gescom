<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\User;
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
        $accountOnline = false;
        $msgReturn = array(
            'type' => 'error',
            'title' => 'Erreur',
            'text' => 'Vous n\'avez pas accès à cette page, veuillez vous connecter !'
        );

        return $this->render('GescomBundle:Pages/User:user_account.html.twig', array(
            'accountOnline' => $accountOnline,
            'return' => $msgReturn,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/inscription", name="register")
     */
    public function addAction(Request $request)
    {
        // We check if auth has rôle ROLE_USER
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // We redirect user, he can't join register page
            return $this->redirectToRoute('userArea');
        }

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setSalt('');
            $user->setPassword($password);
            $user->setRoles(array('ROLE_USER'));

            $em = $this->getDoctrine()->getManager();
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
        // We check if auth has rôle ROLE_USER
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // We redirect user, he can't join login page
            return $this->redirectToRoute('userArea');
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@Gescom/Pages/User/user_connect.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

}