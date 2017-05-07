<?php

namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use GescomBundle\DataFixtures\Data\CategoryData;
use GescomBundle\Entity\Category;

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
        /**
         * Get my faker frDatas
         */
        $fakerCat = new CategoryData();
        $categories = $fakerCat->getDatas();

        /**
         * Category Area
         */
        for ($i = 0; $i < 10; $i++){
            $category = new Category();
            $category->setName($categories[$i][0]);
            $category->setDescription($categories[$i][1]);
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