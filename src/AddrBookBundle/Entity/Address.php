<?php

namespace AddrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AddrBookBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="address")
     */
    private $person;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=100)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="house_num", type="string", length=10)
     */
    private $houseNum;

    /**
     * @var string
     *
     * @ORM\Column(name="flat_num", type="string", length=10)
     */
    private $flatNum;


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
     * Set city
     *
     * @param string $city
     *
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set houseNum
     *
     * @param string $houseNum
     *
     * @return Address
     */
    public function setHouseNum($houseNum)
    {
        $this->houseNum = $houseNum;

        return $this;
    }

    /**
     * Get houseNum
     *
     * @return string
     */
    public function getHouseNum()
    {
        return $this->houseNum;
    }

    /**
     * Set flatNum
     *
     * @param string $flatNum
     *
     * @return Address
     */
    public function setFlatNum($flatNum)
    {
        $this->flatNum = $flatNum;

        return $this;
    }

    /**
     * Get flatNum
     *
     * @return string
     */
    public function getFlatNum()
    {
        return $this->flatNum;
    }

    /**
     * Set person
     *
     * @param \AddrBookBundle\Entity\Person $person
     *
     * @return Address
     */
    public function setPerson(\AddrBookBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \AddrBookBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
