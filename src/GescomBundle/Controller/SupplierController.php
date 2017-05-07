<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Supplier;
use GescomBundle\Form\Supplier\SupplierDeleteType;
use GescomBundle\Form\Supplier\SupplierType;
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
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/liste/{page}", name="supplierList")
     */
    public function indexAction($page = 1)
    {
        /**
         * Get Nbr of element by page
         * Get Nbr of element (total)
         * Count nbr of page needed
         */
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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{supplierId}/modification", name="supplierUpdate")
     *
     * @Security("has_role('ROLE_MODERATOR')")
     */
    public function updateByModeratorAction(Request $request, $supplierId)
    {
        $supplier = $this->getDoctrine()
            ->getRepository('GescomBundle:Supplier')
            ->find($supplierId);
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(SupplierType::class, $supplier);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($supplier);
            $em->flush();
            return $this->redirectToRoute('supplierList');
        }

        return $this->render('GescomBundle:Pages/Supplier:supplier_update.html.twig', array(
            'form'      => $form->createView(),
            'supplier'  => $supplier
        ));
    }

    /**
     * @Route("/{supplierId}/suppression", name="supplierDelete")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Security("has_role('ROLE_MODERATOR')")
     */
    public function deleteProductByModerator(Request $request, $supplierId)
    {
        $supplier = $this->getDoctrine()
            ->getRepository('GescomBundle:Supplier')
            ->find($supplierId);
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(SupplierDeleteType::class, $supplier);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->remove($supplier);
            $em->flush();
        }

        return $this->render('GescomBundle:Pages/Supplier:supplier_delete.html.twig', array(
            'form'      => $form->createView(),
            'supplier'  => $supplier,
        ));
    }

}