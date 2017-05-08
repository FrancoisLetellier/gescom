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
        //$randomProducts = $this->getDoctrine()->getRepository('GescomBundle:Product')
          //  ->getRandomProduct(6);

        $randomProducts = $this->getDoctrine()->getRepository('GescomBundle:Product')
            ->getRandomProductsByCategory(6, "'Télévision'");

        return $this->render('GescomBundle:Pages:index.html.twig', array(
            'randomProducts' => $randomProducts,
        ));
    }

}
