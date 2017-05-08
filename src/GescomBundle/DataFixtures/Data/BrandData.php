<?php

namespace GescomBundle\DataFixtures\Data;

/**
 * Class BrandData
 * @package GescomBundle\DataFixtures\Data
 */
class BrandData
{
    /**
     * @var array
     */
    private $datas;

    public function __construct()
    {
        $this->datas = $this->setDatas();
    }

    /**
     * @return array
     */
    public function getDatas()
    {
        return $this->datas;
    }

    /**
     * @return array
     */
    public function setDatas()
    {
        /**
         * 1st line = name
         */
        return [
            '0' => [
                'Apple'
            ],
            '1' => [
                'Samsung'
            ],
            '2' => [
                'Asus'
            ],
            '3' => [
                'Hp'
            ],
            '4' => [
                'Acer'
            ],
            '5' => [
                'Nokia'
            ],
            '6' => [
                'Dell'
            ],
            '7' => [
                'Sony'
            ],
            '8' => [
                'Toshiba'
            ],
            '9' => [
                'Lenovo'
            ],
            '10' => [
                'Philips'
            ],
        ];
    }
}