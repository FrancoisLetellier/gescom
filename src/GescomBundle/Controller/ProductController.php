<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Product;
use GescomBundle\Entity\ProductSupplier;
use GescomBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/produit", name="product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/1", name="productIndex")
     */
    public function temporaryRedirection()
    {
        return $this->redirectToRoute('productList');
    }

    /**
     * @Route("/{page}", name="productList")
     */
    public function listProductAction($page = 1)
    {
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

        if ($form->isSubmitted() && $form  ->isValid()){
            $suppliers = $product->getProductSupplier()["name"];
            // suppliers are stored with a top level "name" unecessary
            // we must remove this "name" level with this custom method
            $product->resetProductSupplier();
            foreach($suppliers as $supplier){
                // create a new link entity
                $productSupplier = new ProductSupplier();
                // set product
                $productSupplier->setProduct($product);
                // set supplier
                $productSupplier->setSupplier($supplier);
                $em->persist($productSupplier);
                // add supplier to product
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
}
