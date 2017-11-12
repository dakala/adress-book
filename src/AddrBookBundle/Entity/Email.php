<?php

namespace AddrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity(repositoryClass="AddrBookBundle\Repository\EmailRepository")
 */
class Email
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
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="email")
     */
    private $person;

    /**
     * @var string
     *
     * @ORM\Column(name="email_addr", type="string", length=100, unique=true)
     */
    private $emailAddr;

    /**
     * @var string
     *
     * @ORM\Column(name="email_type", type="string", length=100)
     */
    private $emailType;


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
     * Set emailAddr
     *
     * @param string $emailAddr
     *
     * @return Email
     */
    public function setEmailAddr($emailAddr)
    {
        $this->emailAddr = $emailAddr;

        return $this;
    }

    /**
     * Get emailAddr
     *
     * @return string
     */
    public function getEmailAddr()
    {
        return $this->emailAddr;
    }

    /**
     * Set emailType
     *
     * @param string $emailType
     *
     * @return Email
     */
    public function setEmailType($emailType)
    {
        $this->emailType = $emailType;

        return $this;
    }

    /**
     * Get emailType
     *
     * @return string
     */
    public function getEmailType()
    {
        return $this->emailType;
    }

    /**
     * Set person
     *
     * @param \AddrBookBundle\Entity\Person $person
     *
     * @return Email
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
