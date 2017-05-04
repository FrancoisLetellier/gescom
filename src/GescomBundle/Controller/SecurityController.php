<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\SecurityBundle\Tests\Functional\Bundle\CsrfFormLoginBundle\Form\UserLoginType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/connexion", name="login")
     */
    public function loginAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserLoginType::class, $user);
        $form->getErrors();
        $form->handleRequest($request);

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('GescomBundle:Pages/User:user_connect.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}