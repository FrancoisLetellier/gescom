<?php

namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use GescomBundle\DataFixtures\Data\BrandData;
use GescomBundle\Entity\Brand;

/**
 * Class LoadBrandData
 * @package GescomBundle\DataFixtures\ORM
 */
class LoadBrandData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {
        /**
         * Get my faker french Datas
         */
        $fakerBrand = new BrandData();
        $brands = $fakerBrand->getDatas();

        /**
         * Brand Area
         */
        for ($i = 0; $i < 10; $i++){
            $brand = new Brand();
            $brand->setName($brands[$i][0]);
            $em->persist($brand);
            $this->setReference('brand_id_'.$i, $brand);
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
        return 3;
    }

}