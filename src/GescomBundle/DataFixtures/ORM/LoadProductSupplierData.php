<?php

namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use GescomBundle\Entity\ProductSupplier;


/**
 * Class LoadProductData
 * @package GescomBundle\DataFixtures\ORM
 */
class LoadProductSupplierData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {
        /**
         * Product Area
         */
        for ($i = 0; $i < 500; $i++) {
            $randomSupplier = 'supplier_id_' . mt_rand(0, 99);
            $randomProduct = 'product_id_' . mt_rand(0, 499);

            $productSupplier = new ProductSupplier();
            $productSupplier->setProduct($this->getReference($randomProduct));
            $productSupplier->setSupplier($this->getReference($randomSupplier));
            $em->persist($productSupplier);
        }

        /**
         * Save Generates
         */
        $em->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 5;
    }

}