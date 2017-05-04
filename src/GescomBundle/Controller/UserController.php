<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\User;
use GescomBundle\Form\UserLoginType;
use GescomBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package GescomBundle\Controller
 * @Route("/mon-compte", name="userHome")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="userArea")
     */
    public function indexAction()
    {
        return $this->render('GescomBundle:Pages:index.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/inscription", name="userAdd")
     */
    public function addAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/connexion", name="login")
     */
    public function loginAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserLoginType::class, $user);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('GescomBundle:User')
                ->loadUserByUsername($user->getUsername(), $user->getPassword());
            if ($user){
                $this->redirectToRoute('userHome');
            }

        }

        return $this->render('GescomBundle:Pages/User:user_connect.html.twig', array(
            'form' => $form,
        ));
    }
}