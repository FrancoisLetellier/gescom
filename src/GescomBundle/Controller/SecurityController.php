<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\SecurityBundle\Tests\Functional\Bundle\CsrfFormLoginBundle\Form\UserLoginType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class SecurityController
 * @package GescomBundle\Controller
 * @Route("/mon-compte", name="userHome")
 */
class SecurityController extends Controller
{
    /**
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
     * @Route("/inscription", name="register")
     */
    public function addAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $password = $form['password']->getData();
            $user->setPassword($password);
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
     * @Route("/connexion", name="login")
     */
    public function loginAction(Request $request)
    {
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('userHome');
        }

        // Le service authentication_utils permet de récupérer le nom d'utilisateur
        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
        // (mauvais mot de passe par exemple)
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('GescomBundle:Pages/User:user_connect.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }


}