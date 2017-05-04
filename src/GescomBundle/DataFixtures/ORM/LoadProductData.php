<?php

namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use GescomBundle\Entity\Category;
use GescomBundle\Entity\Product;
use GescomBundle\Entity\ProductSupplier;
use GescomBundle\Entity\Supplier;

use Faker;

/**
 * Class LoadProductData
 * @package GescomBundle\DataFixtures\ORM
 */
class LoadProductData implements FixtureInterface
{
    /**
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create();

        /**
         * Product Area
         */
        for ($i = 0; $i < 500; $i++){
            $product = new Product();
            $suppliers = $product->getProductSupplier()["name"];
            $product->resetProductSupplier();

            $product->setName($faker->word);
            $product->setDescription($faker->sentence(5));
            $product->setCategory(new Category());

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
        }

        /**
         * Save Generates
         */
        $em->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}