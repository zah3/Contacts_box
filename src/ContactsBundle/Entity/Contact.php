<?php

namespace ContactsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Contact
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ContactsBundle\Entity\ContactRepository")
 */
class Contact
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
     * @ORM\Column(name="name", type="string", length=60)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=60)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     *
     * @var ArrayColection
     *
     * @ORM\OneToMany(targetEntity="ContactsBundle\Entity\Address", mappedBy="contact")
     */
    private $addresses;

    /**
     *
     * @var ArrayColection
     *
     * @ORM\OneToMany(targetEntity="ContactsBundle\Entity\Phone", mappedBy="contact")
     */
    private $phones;

    /**
     *
     * @var ArrayColection
     *
     * @ORM\OneToMany(targetEntity="ContactsBundle\Entity\Email", mappedBy="contact")
     */
    private $emailAdresses;



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
     * Set name
     *
     * @param string $name
     * @return Contact
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
     * Set surname
     *
     * @param string $surname
     * @return Contact
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Contact
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add addresses
     *
     * @param \ContactsBundle\Entity\Address $addresses
     * @return Contact
     */
    public function addAddress(\ContactsBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \ContactsBundle\Entity\Address $addresses
     */
    public function removeAddress(\ContactsBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add phones
     *
     * @param \ContactsBundle\Entity\Address $phones
     * @return Contact
     */
    public function addPhone(\ContactsBundle\Entity\Phone $phones)
    {
        $this->phones[] = $phones;

        return $this;
    }

    /**
     * Remove phones
     *
     * @param \ContactsBundle\Entity\Address $phones
     */
    public function removePhone(\ContactsBundle\Entity\Phone $phones)
    {
        $this->phones->removeElement($phones);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add emailAdresses
     *
     * @param \ContactsBundle\Entity\Email
     * @return Contact
     */
    public function addEmailAdress(\ContactsBundle\Entity\Email $emailAdresses)
    {
        $this->emailAdresses[] = $emailAdresses;

        return $this;
    }

    /**
     * Remove emailAdresses
     *
     * @param \ContactsBundle\Entity\Address $emailAdresses
     */
    public function removeEmailAdress(\ContactsBundle\Entity\Email $emailAdresses)
    {
        $this->emailAdresses->removeElement($emailAdresses);
    }

    /**
     * Get emailAdresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmailAdresses()
    {
        return $this->emailAdresses;
    }
}
