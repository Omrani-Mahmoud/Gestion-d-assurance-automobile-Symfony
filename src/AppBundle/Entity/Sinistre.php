<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sinistre
 *
 * @ORM\Table(name="sinistre")
 * @ORM\Entity
 */
class Sinistre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_declaration", type="datetime", nullable=false)
     */
    private $dateDeclaration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_sinistre", type="datetime", nullable=false)
     */
    private $dateSinistre;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_sinistre", type="string", length=200, nullable=false)
     */
    private $lieuSinistre;

    /**
     * @var string
     *
     * @ORM\Column(name="dommage_corps", type="string", length=200, nullable=true)
     */
    private $dommageCorps;

    /**
     * @var string
     *
     * @ORM\Column(name="cin_conducteur", type="string", length=8, nullable=true)
     */
    private $cin_conducteur;

    /**
     * @var string
     *
     * @ORM\Column(name="dommage_materiel", type="string", length=200, nullable=true)
     */
    private $dommageMateriel;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Police",inversedBy="sinistres")
     */
    private $contrat;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vehicule",inversedBy="sinistres")
     * @ORM\JoinColumns(value={
     *      @ORM\JoinColumn(name="chassis_number", referencedColumnName="chassis"),
     *     @ORM\JoinColumn(name="modele_id", referencedColumnName="modele")
     *     })
     */
    private $vehicule;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Reclamation",inversedBy="codeSinistre")
     * @ORM\JoinColumn(referencedColumnName="code_rec")
     */
    private $reclamation;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Temoin",mappedBy="sinistre")
     */
    private $temoins;

    /**
     * Sinistre constructor.
     */
    public function __construct()
    {
        $this->dateDeclaration = new \DateTime('now');
    }

    /**
     * Set dateDeclaration
     *
     * @param \DateTime $dateDeclaration
     *
     * @return Sinistre
     */
    public function setDateDeclaration($dateDeclaration)
    {
        $this->dateDeclaration = $dateDeclaration;

        return $this;
    }

    /**
     * Get dateDeclaration
     *
     * @return \DateTime
     */
    public function getDateDeclaration()
    {
        return $this->dateDeclaration;
    }

    /**
     * Set dateSinistre
     *
     * @param \DateTime $dateSinistre
     *
     * @return Sinistre
     */
    public function setDateSinistre($dateSinistre)
    {
        $this->dateSinistre = $dateSinistre;

        return $this;
    }

    /**
     * Get dateSinistre
     *
     * @return \DateTime
     */
    public function getDateSinistre()
    {
        return $this->dateSinistre;
    }

    /**
     * Set lieuSinistre
     *
     * @param string $lieuSinistre
     *
     * @return Sinistre
     */
    public function setLieuSinistre($lieuSinistre)
    {
        $this->lieuSinistre = $lieuSinistre;

        return $this;
    }

    /**
     * Get lieuSinistre
     *
     * @return string
     */
    public function getLieuSinistre()
    {
        return $this->lieuSinistre;
    }

    /**
     * Set dommageCorps
     *
     * @param string $dommageCorps
     *
     * @return Sinistre
     */
    public function setDommageCorps($dommageCorps)
    {
        $this->dommageCorps = $dommageCorps;

        return $this;
    }

    /**
     * Get dommageCorps
     *
     * @return string
     */
    public function getDommageCorps()
    {
        return $this->dommageCorps;
    }

    /**
     * Set dommageMateriel
     *
     * @param string $dommageMateriel
     *
     * @return Sinistre
     */
    public function setDommageMateriel($dommageMateriel)
    {
        $this->dommageMateriel = $dommageMateriel;

        return $this;
    }

    /**
     * Get dommageMateriel
     *
     * @return string
     */
    public function getDommageMateriel()
    {
        return $this->dommageMateriel;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getCinConducteur()
    {
        return $this->cin_conducteur;
    }

    /**
     * @param string $cin_conducteur
     */
    public function setCinConducteur($cin_conducteur)
    {
        $this->cin_conducteur = $cin_conducteur;
    }

    /**
     * @return mixed
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * @param mixed $contrat
     */
    public function setContrat($contrat)
    {
        $this->contrat = $contrat;
    }

    /**
     * @return mixed
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * @param mixed $vehicule
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;
    }

    /**
     * @return mixed
     */
    public function getReclamation()
    {
        return $this->reclamation;
    }

    /**
     * @param mixed $reclamation
     */
    public function setReclamation($reclamation)
    {
        $this->reclamation = $reclamation;
    }

    /**
     * @return mixed
     */
    public function getTemoins()
    {
        return $this->temoins;
    }

    /**
     * @param mixed $temoins
     */
    public function setTemoins($temoins)
    {
        $this->temoins = $temoins;
    }


}
