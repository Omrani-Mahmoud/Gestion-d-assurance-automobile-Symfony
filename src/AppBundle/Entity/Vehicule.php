<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @var string
     *
     * @ORM\Column(name="chassis", type="string", length=17, nullable=false)
     * @ORM\Id()
     */
    private $chassis;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=20, nullable=false)
     * @ORM\Id()
     */
    private $modele;
    /**
     * @var \DateTime
     *
     *
     * @ORM\Column(name="date_circule", type="datetime", nullable=false)
     */
    private $dateCircule;

    /**
     * @var integer
     *
     * @ORM\Column(name="puissance", type="integer", nullable=false)
     */
    private $puissance;

    /**
     * @var string
     *
     * @ORM\Column(name="carburant", type="string", length=20, nullable=false)
     */
    private $carburant;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_pneu", type="integer", nullable=false)
     */
    private $nombrePneu = '4';

    /**
     * @var float
     *
     * @ORM\Column(name="val_venale", type="float", precision=10, scale=0, nullable=false)
     */
    private $valVenale;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Police", inversedBy="vehicules")
     */
    private $refContrat;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PrimeRC",inversedBy="vehicules")
     */
    private $primeRC;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sinistre",mappedBy="vehicule")
     * @ORM\JoinColumn(referencedColumnName="code")
     */
    private $sinistres;

    /**
     * Vehicule constructor.
     * @param string $chassis
     * @param string $modele
     * @param int $puissance
     * @param string $carburant
     */
    public function __construct($chassis, $modele, $puissance, $carburant)
    {
        $this->chassis = $chassis;
        $this->modele = $modele;
        $this->puissance = $puissance;
        $this->carburant = $carburant;
    }

    /**
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @param string $modele
     */
    public function setModele($modele)
    {
        $this->modele = $modele;
    }

    /**
     * Set dateCircule
     *
     * @param \DateTime $dateCircule
     *
     * @return Vehicule
     */
    public function setDateCircule($dateCircule)
    {
        $this->dateCircule = $dateCircule;

        return $this;
    }

    /**
     * Get dateCircule
     *
     * @return \DateTime
     */
    public function getDateCircule()
    {
        return $this->dateCircule;
    }

    /**
     * Set puissance
     *
     * @param integer $puissance
     *
     * @return Vehicule
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get puissance
     *
     * @return integer
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * Set carburant
     *
     * @param string $carburant
     *
     * @return Vehicule
     */
    public function setCarburant($carburant)
    {
        $this->carburant = $carburant;

        return $this;
    }

    /**
     * Get carburant
     *
     * @return string
     */
    public function getCarburant()
    {
        return $this->carburant;
    }

    /**
     * Set nombrePneu
     *
     * @param integer $nombrePneu
     *
     * @return Vehicule
     */
    public function setNombrePneu($nombrePneu)
    {
        $this->nombrePneu = $nombrePneu;

        return $this;
    }

    /**
     * Get nombrePneu
     *
     * @return integer
     */
    public function getNombrePneu()
    {
        return $this->nombrePneu;
    }

    /**
     * Set valVenale
     *
     * @param float $valVenale
     *
     * @return Vehicule
     */
    public function setValVenale($valVenale)
    {
        $this->valVenale = $valVenale;

        return $this;
    }

    /**
     * Get valVenale
     *
     * @return float
     */
    public function getValVenale()
    {
        return $this->valVenale;
    }

    /**
     * Set refContrat
     *
     * @param integer $refContrat
     *
     * @return Vehicule
     */
    public function setRefContrat($refContrat)
    {
        $this->refContrat = $refContrat;

        return $this;
    }

    /**
     * Get refContrat
     *
     * @return integer
     */
    public function getRefContrat()
    {
        return $this->refContrat;
    }

    /**
     * Set garantieLegal
     *
     * @param integer $garantieLegal
     *
     * @return Vehicule
     */
    public function setGarantieLegal($garantieLegal)
    {
        $this->garantieLegal = $garantieLegal;

        return $this;
    }

    /**
     * Get garantieLegal
     *
     * @return integer
     */
    public function getGarantieLegal()
    {
        return $this->garantieLegal;
    }

    /**
     * Get chassis
     *
     * @return string
     */
    public function getChassis()
    {
        return $this->chassis;
    }
    /**
     * Set valVenale
     *
     * @param string $chassis
     *
     * @return Vehicule
     */
    public function setChassis($chassis)
    {
        $this->chassis = $chassis;
    }

    /**
     * @return mixed
     */
    public function getPrimeRC()
    {
        return $this->primeRC;
    }

    /**
     * @param mixed $primeRC
     */
    public function setPrimeRC($primeRC)
    {
        $this->primeRC = $primeRC;
    }

    /**
     * @return mixed
     */
    public function getSinistres()
    {
        return $this->sinistres;
    }

    /**
     * @param mixed $sinistres
     */
    public function setSinistres($sinistres)
    {
        $this->sinistres = $sinistres;
    }

}
