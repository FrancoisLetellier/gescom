<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Supplier;
use GescomBundle\Form\SupplierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SupplierController
 * @package GescomBundle\Controller
 * @Route("/fournisseur", name="supplierHome")
 */
class SupplierController extends Controller
{
    /**
     * @Route("/", name="supplierList")
     */
    public function indexAction()
    {
        $suppliers = $this->getDoctrine()->getRepository('GescomBundle:Supplier')->findAll();

        return $this->render('GescomBundle:Pages/Supplier:supplier_list.html.twig', [
            'suppliers'  => $suppliers,
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/nouveau", name="supplierAdd")
     */
    public function addAction(Request $request)
    {
        $supplier = new Supplier();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(SupplierType::class, $supplier);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($supplier);
            $em->flush();
        }


        return $this->render('GescomBundle:Pages/Supplier:supplier_add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}