<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as FOSUser;


/**
 * Assure
 *
 * @ORM\Entity
 */
class Assure extends User
{    /**
     * @var string
     *
     * @ORM\Column(name="CIN", type="string", length=8, nullable=true)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_social", type="string", length=8, nullable=true)
     */
    private $raison_social;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_societe", type="string", length=8, nullable=true)
     */
    private $responsable_societe;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=20, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=20, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=200, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Tel", type="string", length=8, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="Gender", type="string", length=8, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="Fax", type="string", length=8, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="Profession", type="string", length=60, nullable=true)
     */
    private $profession;

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @var Date
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @return Date
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param Date $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }



    /**
     * @var DateTime
     *
     * @ORM\Column(name="Date_enreg", type="datetime", nullable=true)
     */
    private $dateEnreg;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Police", mappedBy="codeAssure")
     */
    private $contrats;

    /**
     * Assure constructor.
     */
    public function __construct($username,$email,$role)
    {
        parent::__construct($username,$email,$role);
        $this->dateEnreg = new DateTime('now');
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return Assure
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Assure
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Assure
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Assure
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Assure
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Assure
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set profession
     *
     * @param string $profession
     *
     * @return Assure
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set dateEnreg
     *
     * @param DateTime $dateEnreg
     *
     * @return Assure
     */
    public function setDateEnreg($dateEnreg)
    {
        $this->dateEnreg = $dateEnreg;

        return $this;
    }

    /**
     * Get dateEnreg
     *
     * @return DateTime
     */
    public function getDateEnreg()
    {
        return $this->dateEnreg;
    }

    /**
     * @return string
     */
    public function getRaisonSocial()
    {
        return $this->raison_social;
    }

    /**
     * @param string $raison_social
     */
    public function setRaisonSocial($raison_social)
    {
        $this->raison_social = $raison_social;
    }

    /**
     * @return string
     */
    public function getResponsableSociete()
    {
        return $this->responsable_societe;
    }

    /**
     * @param string $responsable_societe
     */
    public function setResponsableSociete(string $responsable_societe)
    {
        $this->responsable_societe = $responsable_societe;
    }

    /**
     * @return mixed
     */
    public function getContrats()
    {
        return $this->contrats;
    }

    /**
     * @param mixed $contrats
     */
    public function setContrats($contrats)
    {
        $this->contrats = $contrats;
    }
}
