<?php

namespace GescomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $randomTv = $this->getDoctrine()->getRepository('GescomBundle:Product')
            ->getRandomProductsByCategory(4, "'Télévision'");

        $randomSmartphone = $this->getDoctrine()->getRepository('GescomBundle:Product')
            ->getRandomProductsByCategory(4, "'Smartphone'");

        $randomComputer = $this->getDoctrine()->getRepository('GescomBundle:Product')
            ->getRandomProductsByCategory(4, "'Ordinateur portable'");

        return $this->render('GescomBundle:Pages:index.html.twig', array(
            'randomTv' => $randomTv,
            'randomSmartphone' => $randomSmartphone,
            'randomComputer' => $randomComputer,
        ));
    }

}
