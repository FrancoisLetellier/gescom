<?php

namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use GescomBundle\Entity\Category;


use Faker;

/**
 * Class LoadCategoryData
 * @package GescomBundle\DataFixtures\ORM
 */
class LoadCategoryData  extends AbstractFixture implements OrderedFixtureInterface
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
            $this->setReference('category_id_'.$i, $category);
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
        return 1;
    }

}