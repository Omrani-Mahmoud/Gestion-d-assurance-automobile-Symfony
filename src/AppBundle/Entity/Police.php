<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Police
 *
 * @ORM\Table(name="police")
 * @ORM\Entity
 */
class Police
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_effet_police", type="datetime", nullable=false)
     */
    private $date_effet_police;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_echeance", type="datetime", nullable=true)
     */
    private $dateEcheance;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=20, nullable=true)
     */
    private $statut;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=true)
     */
    private $montant;

    /**
     * @var integer
     *
     * @ORM\Column(name="classe", type="integer", nullable=true)
     */
    private $classe;

    /**
     * @var float
     *
     * @ORM\Column(name="coef_classe", type="float", nullable=true)
     */
    private $coef_classe;

    /**
     * @var string
     *
     * @ORM\Column(name="nature", type="string", nullable=true)
     */
    private $nature;

    /**
     * @var string
     *
     * @ORM\Column(name="usage_contrat", type="string", nullable=true)
     */
    private $usage_contrat;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Assure",inversedBy="contrats")
     */
    private $codeAssure;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Vehicule",mappedBy="refContrat")
     */
    private $vehicules;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Agence", inversedBy="contrats")
     */
    private $agence;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Sinistre",mappedBy="contrat")
     * @ORM\JoinColumn(referencedColumnName="code")
     */
    private $sinistres;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\GarantieComplementaire",mappedBy="contrat")
     * @ORM\JoinTable(name="police_garantis")
     */
    private $garantis;

    /**
     * Set dateSigne
     *
     * @param \DateTime $dateSigne
     *
     * @return Police
     */
    public function setDateEffetPolice($dateSigne)
    {
        $this->date_effet_police = $dateSigne;

        return $this;
    }

    /**
     * Get dateSigne
     *
     * @return \DateTime
     */
    public function getDateEffetPolice()
    {
        return $this->date_effet_police;
    }

    /**
     * Set dateEcheance
     *
     * @param \DateTime $dateEcheance
     *
     * @return Police
     */
    public function setDateEcheance($dateEcheance)
    {
        $this->dateEcheance = $dateEcheance;

        return $this;
    }

    /**
     * Get dateEcheance
     *
     * @return \DateTime
     */
    public function getDateEcheance()
    {
        return $this->dateEcheance;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Police
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Police
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set classe
     *
     * @param integer $classe
     *
     * @return Police
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return integer
     */
    public function getClasse()
    {
        return $this->classe;
    }

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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getCoefClasse()
    {
        return $this->coef_classe;
    }

    /**
     * @param float $coef_classe
     */
    public function setCoefClasse($coef_classe)
    {
        $this->coef_classe = $coef_classe;
    }

    /**
     * @return string
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * @param string $nature
     */
    public function setNature($nature)
    {
        $this->nature = $nature;
    }

    /**
     * @return string
     */
    public function getUsageContrat()
    {
        return $this->usage_contrat;
    }

    /**
     * @param string $usage_contrat
     */
    public function setUsageContrat($usage_contrat)
    {
        $this->usage_contrat = $usage_contrat;
    }

    /**
     * @return int
     */
    public function getCodeAssure()
    {
        return $this->codeAssure;
    }

    /**
     * @param int $codeAssure
     */
    public function setCodeAssure($codeAssure)
    {
        $this->codeAssure = $codeAssure;
    }

    /**
     * @return mixed
     */
    public function getVehicules()
    {
        return $this->vehicules;
    }

    /**
     * @param mixed $vehicules
     */
    public function setVehicules($vehicules)
    {
        $this->vehicules = $vehicules;
    }

    /**
     * @return mixed
     */
    public function getAgence()
    {
        return $this->agence;
    }

    /**
     * @param mixed $agence
     */
    public function setAgence($agence)
    {
        $this->agence = $agence;
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

    /**
     * @return mixed
     */
    public function getAvenants()
    {
        return $this->avenants;
    }

    /**
     * @param mixed $avenants
     */
    public function setAvenants($avenants)
    {
        $this->avenants = $avenants;
    }

    /**
     * @return mixed
     */
    public function getGarantis()
    {
        return $this->garantis;
    }

    /**
     * @param mixed $garantis
     */
    public function setGarantis($garantis)
    {
        $this->garantis = $garantis;
    }


}
