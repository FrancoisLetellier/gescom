<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Product;
use GescomBundle\Entity\ProductSupplier;
use GescomBundle\Form\Product\ProductDeleteType;
use GescomBundle\Form\Product\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class ProductController
 * @package GescomBundle\Controller
 * @Route("/produit", name="productHome")
 */
class ProductController extends Controller
{

    /**
     * @Route("/liste/{page}", name="productList")
     */
    public function listProductAction($page = 1)
    {
        /**
         * Get Nbr of element by page
         * Get Nbr of element (total)
         * Count nbr of page needed
         */
        $maxProduct = 20;
        $product_count = 500;
        $pagination = array(
            'page' => $page,
            'route' => 'productList',
            'pages_count' => ceil($product_count / $maxProduct),
            'route_params' => array()
        );

        $products = $this->getDoctrine()->getRepository('GescomBundle:Product')
            ->getListByPage($page, $maxProduct);

        return $this->render('GescomBundle:Pages/Product:product_list.html.twig', array(
            'pagination' => $pagination,
            'products'  => $products,
        ));
    }

    /**
     * @Route("/nouveau", name="productAdd")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Security("has_role('ROLE_VENDOR')")
     */
    public function addProductAction(Request $request)
    {
        $product = new Product();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProductType::class, $product);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            /**
             * Here we need to kept all suppliers in var
             * and clean ! After need to set product & supplier
             * Can save it
             */
            $suppliers = $product->getProductSupplier()["name"];
            $product->resetProductSupplier();
            foreach($suppliers as $supplier){
                $productSupplier = new ProductSupplier();
                $productSupplier->setProduct($product);
                $productSupplier->setSupplier($supplier);
                $em->persist($productSupplier);
                $product->addProductSupplier($productSupplier);
            }
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('productList');
        }

        return $this->render('GescomBundle:Pages/Product:product_add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{productId}/modification", name="productUpdate")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Security("has_role('ROLE_MODERATOR')")
     */
    public function updateProductByModerator(Request $request, $productId)
    {
        $product = $this->getDoctrine()
            ->getRepository('GescomBundle:Product')
            ->find($productId);
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProductType::class, $product);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            /**
             * Here we need to kept all suppliers in var
             * and clean ! After need to set product & supplier
             * Can save it
             */
            $suppliers = $product->getProductSupplier()["name"];
            $product->resetProductSupplier();
            foreach($suppliers as $supplier){
                $productSupplier = new ProductSupplier();
                $productSupplier->setProduct($product);
                $productSupplier->setSupplier($supplier);
                $em->persist($productSupplier);
                $product->addProductSupplier($productSupplier);
            }
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('productList');
        }

        return $this->render('GescomBundle:Pages/Product:product_update.html.twig', array(
            'form'      => $form->createView(),
            'product'   => $product,
        ));
    }

    /**
     * @Route("/{productId}/suppression", name="productDelete")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Security("has_role('ROLE_MODERATOR')")
     */
    public function deleteProductByModerator(Request $request, $productId)
    {
        $product = $this->getDoctrine()
            ->getRepository('GescomBundle:Product')
            ->find($productId);
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProductDeleteType::class, $product);
        $form->getErrors();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->remove($product);
            $em->flush();
        }

        return $this->render('GescomBundle:Pages/Product:product_delete.html.twig', array(
            'form'      => $form->createView(),
            'product'   => $product,
        ));
    }

}
