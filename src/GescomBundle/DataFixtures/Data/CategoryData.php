<?php

namespace GescomBundle\DataFixtures\Data;

/**
 * Class CategoryData
 * @package GescomBundle\DataFixtures\Data
 */
class CategoryData
{
    /**
     * @var array
     */
    private $datas;

    /**
     * @return array
     */
    public function getDatas()
    {
        return $this->datas;
    }

    /**
     * CategoryData constructor.
     */
    public function __construct()
    {
        $this->datas = $this->getDataList();
    }

    /**
     * @return array
     */
    private function getDataList()
    {
        /**
         * 1st line = name
         * 2st line = description
         */
        return $categoryList = [
            '0' => [
                'Ecran',
                'Ecran et moniteurs.'
            ],
            '1' => [
                'Smartphone',
                'Smartphone dernière génération.'
            ],
            '2' => [
                'Télévision',
                'Des télévision diverses et variées.'
            ],
            '3' => [
                'Ordinateur portable',
                'Des ordinateurs portable, mobilité garantie !'
            ],
            '4' => [
                'Ordinateur de bureau',
                'Des ordinateurs de bureau pour tous, bureautique, multimédia, ect...'
            ],
            '5' => [
                'Accessoires ordinateur',
                'Tous les types d\'accessoires ordinateurs'
            ],
            '6' => [
                'Montre connectée',
                'Montres connectées de toutes tailles et de toutes marques'
            ],
            '7' => [
                'Connectique',
                'Connectique de tous type !'
            ],
            '8' => [
                'Audio',
                'L\'audio pour toute la maison'
            ],
            '9' => [
                'Tablette',
                'Tablettes de toutes marques !'
            ],
        ];
    }
}
