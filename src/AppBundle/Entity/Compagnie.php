<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compagnie
 *
 * @ORM\Entity
 */
class Compagnie extends User
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_compagnie", type="string", length=100, nullable=false)
     */
    private $nomCompagnie;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="fixe", type="string", length=20, nullable=false)
     */
    private $fixe;

    /**
     * @var integer
     *
     * @ORM\Column(name="fax", type="integer", nullable=false)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=200, nullable=false)
     */
    private $site;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CourtierCompagnie", mappedBy="compagnie")
     */
    private $CourtierCompagnie;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Agence",mappedBy="compagnie")
     */
    private $agences;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GarantieComplementaire",mappedBy="compagnie")
     */
    private $garantis;
    /**
     * Compagnie constructor.
     * @param $courtiers
     */

    public function __construct($u,$e,$r)
    {
        parent::__construct($u,$e,$r);
        $this->courtiers = [];
    }

    /**
     * @return mixed
     */
    public function getCourtierCompagnie()
    {
        return $this->CourtierCompagnie;
    }

    /**
     * @param mixed $CourtierCompagnie
     */
    public function setCourtierCompagnie($CourtierCompagnie)
    {
        $this->CourtierCompagnie = $CourtierCompagnie;
    }

    /**
     * @return mixed
     */
    public function getAgences()
    {
        return $this->agences;
    }

    /**
     * @param mixed $agences
     */
    public function setAgences($agences)
    {
        $this->agences = $agences;
    }



    /**
     * Set nomCompagnie
     *
     * @param string $nomCompagnie
     *
     * @return Compagnie
     */
    public function setNomCompagnie($nomCompagnie)
    {
        $this->nomCompagnie = $nomCompagnie;

        return $this;
    }

    /**
     * Get nomCompagnie
     *
     * @return string
     */
    public function getNomCompagnie()
    {
        return $this->nomCompagnie;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Compagnie
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
     * Set fixe
     *
     * @param string $fixe
     *
     * @return Compagnie
     */
    public function setFixe($fixe)
    {
        $this->fixe = $fixe;

        return $this;
    }

    /**
     * Get fixe
     *
     * @return string
     */
    public function getFixe()
    {
        return $this->fixe;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     *
     * @return Compagnie
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return integer
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set site
     *
     * @param string $site
     *
     * @return Compagnie
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nomCompagnie;
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
