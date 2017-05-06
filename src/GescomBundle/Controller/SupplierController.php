<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Supplier;
use GescomBundle\Form\SupplierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class SupplierController
 * @package GescomBundle\Controller
 * @Route("/fournisseur", name="supplierHome")
 */
class SupplierController extends Controller
{
    /**
     * @Route("/{page}", name="supplierList")
     */
    public function indexAction($page = 1)
    {
        $maxSupplier = 20;
        $supplier_count = 500;
        $pagination = array(
            'page' => $page,
            'route' => 'supplierList',
            'pages_count' => ceil($supplier_count / $maxSupplier),
            'route_params' => array()
        );

        $suppliers = $this->getDoctrine()->getRepository('GescomBundle:Supplier')
            ->getListByPage($page, $maxSupplier);


        return $this->render('GescomBundle:Pages/Supplier:supplier_list.html.twig', array(
            'pagination' => $pagination,
            'suppliers'  => $suppliers,
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/nouveau", name="supplierAdd")
     *
     * @Security("has_role('ROLE_MODERATOR')")
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