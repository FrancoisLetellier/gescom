<?php

namespace GescomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supplier
 *
 * @ORM\Table(name="supplier")
 * @ORM\Entity(repositoryClass="GescomBundle\Repository\SupplierRepository")
 */
class Supplier
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="postalCode", type="integer")
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=255)
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="webUrl", type="string", length=255)
     */
    private $webUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="deliveryTime", type="integer")
     */
    private $deliveryTime;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @var ProductSupplier
     *
     * @ORM\OneToMany(targetEntity="ProductSupplier", mappedBy="supplier", cascade={"remove"})
     */
    private $productSupplier;


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
     * Set name
     *
     * @param string $name
     *
     * @return Supplier
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Supplier
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Supplier
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     *
     * @return Supplier
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return Supplier
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Supplier
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set welUrl
     *
     * @param string $welUrl
     *
     * @return Supplier
     */
    public function setWelUrl($welUrl)
    {
        $this->welUrl = $welUrl;

        return $this;
    }

    /**
     * Get welUrl
     *
     * @return string
     */
    public function getWelUrl()
    {
        return $this->welUrl;
    }

    /**
     * Set deliveryTime
     *
     * @param integer $deliveryTime
     *
     * @return Supplier
     */
    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;

        return $this;
    }

    /**
     * Get deliveryTime
     *
     * @return int
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return Supplier
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productSupplier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add productSupplier
     *
     * @param \GescomBundle\Entity\ProductSupplier $productSupplier
     *
     * @return Supplier
     */
    public function addProductSupplier(\GescomBundle\Entity\ProductSupplier $productSupplier)
    {
        $this->productSupplier[] = $productSupplier;

        return $this;
    }

    /**
     * Remove productSupplier
     *
     * @param \GescomBundle\Entity\ProductSupplier $productSupplier
     */
    public function removeProductSupplier(\GescomBundle\Entity\ProductSupplier $productSupplier)
    {
        $this->productSupplier->removeElement($productSupplier);
    }

    /**
     * Get productSupplier
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductSupplier()
    {
        return $this->productSupplier;
    }

    /**
     * Set webUrl
     *
     * @param string $webUrl
     *
     * @return Supplier
     */
    public function setWebUrl($webUrl)
    {
        $this->webUrl = $webUrl;

        return $this;
    }

    /**
     * Get webUrl
     *
     * @return string
     */
    public function getWebUrl()
    {
        return $this->webUrl;
    }
}
