<?php

namespace AddrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phone
 *
 * @ORM\Table(name="phone")
 * @ORM\Entity(repositoryClass="AddrBookBundle\Repository\PhoneRepository")
 */
class Phone
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
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="phone")
     */
    private $person;


    /**
     * @var string
     *
     * @ORM\Column(name="phone_num", type="string", length=50)
     */
    private $phoneNum;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_type", type="string", length=150)
     */
    private $phoneType;


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
     * Set phoneNum
     *
     * @param string $phoneNum
     *
     * @return Phone
     */
    public function setPhoneNum($phoneNum)
    {
        $this->phoneNum = $phoneNum;

        return $this;
    }

    /**
     * Get phoneNum
     *
     * @return string
     */
    public function getPhoneNum()
    {
        return $this->phoneNum;
    }

    /**
     * Set phoneType
     *
     * @param string $phoneType
     *
     * @return Phone
     */
    public function setPhoneType($phoneType)
    {
        $this->phoneType = $phoneType;

        return $this;
    }

    /**
     * Get phoneType
     *
     * @return string
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }

    /**
     * Set person
     *
     * @param \AddrBookBundle\Entity\Person $person
     *
     * @return Phone
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
