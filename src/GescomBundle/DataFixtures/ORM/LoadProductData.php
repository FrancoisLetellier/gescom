<?php

namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use GescomBundle\DataFixtures\Data\BrandData;
use GescomBundle\DataFixtures\Data\ImageData;
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
            $randomBrand    = 'brand_id_' . mt_rand(0, 9);
            $randomCategory = 'category_id_' . mt_rand(0, 9);

            $product = new Product();
            $product->setName(implode('', $faker->words(1)));
            $product->setBrand($this->getReference($randomBrand));
            $product->setCategory($this->getReference($randomCategory));
            $product->setName(implode(' ', $faker->words(2)));
            $product->setDescription($faker->sentence(5));
            $em->persist($product);

            $this->setReference('product_id_'.$i, $product);
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
        return 4;
    }

}