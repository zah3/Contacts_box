<?php

namespace ContactsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Address
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ContactsBundle\Entity\AddressRepository")
 */
class Address
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="steet", type="string", length=100)
     */
    private $steet;

    /**
     * @var integer
     *
     * @ORM\Column(name="houseNumber", type="integer")
     */
    private $houseNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="floatNumber", type="integer")
     */
    private $floatNumber;

    /**
     *
     * @var ArrayColection
     * 
     * @ORM\ManyToOne(targetEntity="ContactsBundle\Entity\Contact", inversedBy="addresses")
     * @JoinColumn(name="contact_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $contact;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set city
     *
     * @param string $city
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
     * Set steet
     *
     * @param string $steet
     * @return Address
     */
    public function setSteet($steet)
    {
        $this->steet = $steet;

        return $this;
    }

    /**
     * Get steet
     *
     * @return string 
     */
    public function getSteet()
    {
        return $this->steet;
    }

    /**
     * Set houseNumber
     *
     * @param integer $houseNumber
     * @return Address
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return integer 
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set floatNumber
     *
     * @param integer $floatNumber
     * @return Address
     */
    public function setFloatNumber($floatNumber)
    {
        $this->floatNumber = $floatNumber;

        return $this;
    }

    /**
     * Get floatNumber
     *
     * @return integer 
     */
    public function getFloatNumber()
    {
        return $this->floatNumber;
    }

    /**
     * Set contact
     *
     * @param \ContactsBundle\Entity\Contact $contact
     * @return Address
     */
    public function setContact(\ContactsBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \ContactsBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }
}
