<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Category;
use GescomBundle\Form\Category\CategoryDeleteType;
use GescomBundle\Form\Category\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     *
     * @Security("has_role('ROLE_MODERATOR')")
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

        return $this->render('GescomBundle:Pages/Category:category_update.html.twig', array(
            'form'      => $form->createView(),
            'category'   => $category,
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{categoryId}/modification", name="categoryUpdate")
     *
     * @Security("has_role('ROLE_MODERATOR')")
     */
    public function updateByModeratorAction(Request $request, $categoryId)
    {
        $category = $this->getDoctrine()
            ->getRepository('GescomBundle:Category')
            ->find($categoryId);
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CategoryType::class, $category);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('categoryList');
        }

        return $this->render('GescomBundle:Pages/Category:category_update.html.twig', array(
            'form'      => $form->createView(),
            'category'  => $category
        ));
    }

    /**
     * @Route("/{categoryId}/suppression", name="categoryDelete")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Security("has_role('ROLE_MODERATOR')")
     */
    public function deleteProductByModerator(Request $request, $categoryId)
    {
        $category = $this->getDoctrine()
            ->getRepository('GescomBundle:Category')
            ->find($categoryId);
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CategoryDeleteType::class, $category);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->remove($category);
            $em->flush();
        }

        return $this->render('GescomBundle:Pages/Category:category_delete.html.twig', array(
            'form'      => $form->createView(),
            'category'   => $category,
        ));
    }
}