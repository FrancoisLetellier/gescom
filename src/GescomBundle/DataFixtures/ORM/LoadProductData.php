<?php

namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use GescomBundle\Entity\Product;

use Faker;

/**
 * Class LoadProductData
 * @package GescomBundle\DataFixtures\ORM
 */
class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
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
            $randomCategory = 'category_id_' . mt_rand(0, 9);

            $product = new Product();
            $product->setName($faker->word);
            $product->setDescription($faker->sentence(5));
            $product->setCategory($this->getReference($randomCategory));
            $em->persist($product);

            $this->setReference('product_id_'.$i, $product);
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