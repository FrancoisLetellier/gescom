<?php

namespace GescomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductSupplier
 *
 * @ORM\Table(name="product_supplier")
 * @ORM\Entity(repositoryClass="GescomBundle\Repository\ProductSupplierRepository")
 */
class ProductSupplier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productSupplier")
     */
    private $product;

    /**
     * @var Supplier
     *
     * @ORM\ManyToOne(targetEntity="Supplier", inversedBy="productSupplier")
     */
    private $supplier;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set product
     *
     * @param \GescomBundle\Entity\Product $product
     *
     * @return ProductSupplier
     */
    public function setProduct(\GescomBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \GescomBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set supplier
     *
     * @param \GescomBundle\Entity\Supplier $supplier
     *
     * @return ProductSupplier
     */
    public function setSupplier(\GescomBundle\Entity\Supplier $supplier = null)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \GescomBundle\Entity\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

}
