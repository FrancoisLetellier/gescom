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
 * Class LoadCategoryData
 * @package GescomBundle\DataFixtures\ORM
 */
class LoadCategoryData implements FixtureInterface
{
    /**
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {

        $faker = Faker\Factory::create();
        /**
         * Category Area
         */
        for ($i = 0; $i < 10; $i++){
            $category = new Category();
            $category->setName(implode($faker->words(2)));
            $category->setDescription($faker->sentence(5));
            $em->persist($category);
        }
        /**
         * Save Generates
         */
        $em->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}