<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Category;
use GescomBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SupplierController
 * @package GescomBundle\Controller
 * @Route("/categorie", name="categoryHome")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="categoryList")
     */
    public function indexAction()
    {
        $categorys = $this->getDoctrine()->getRepository('GescomBundle:Category')->findAll();

        return $this->render('GescomBundle:Pages/Category:category_list.html.twig', [
            'categorys'  => $categorys,
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/nouveau", name="categoryAdd")
     */
    public function addAction(Request $request)
    {
        $category = new Category();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CategoryType::class, $category);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($category);
            $em->flush();
        }

        return $this->render('GescomBundle:Pages/Category:category_add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}