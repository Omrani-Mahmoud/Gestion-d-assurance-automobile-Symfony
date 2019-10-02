<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as FOSUser;

/**
 * Expert
 *
 * @ORM\Entity
 */
class Expert extends User
{    /**
     * @var string
     *
     * @ORM\Column(name="cin_exp", type="string", length=8, nullable=false)
     */
    private $cinExp;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_exp", type="string", length=20, nullable=false)
     */
    private $nomExp;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_exp", type="string", length=20, nullable=false)
     */
    private $prenomExp;

    /**
     * @var string
     *
     * @ORM\Column(name="zone_exp", type="string", length=20, nullable=false)
     */
    private $zoneExp;

    /**
     * @var integer
     *
     * @ORM\Column(name="tel_exp", type="integer", nullable=false)
     */
    private $telExp;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reclamation",mappedBy="expert")
     */
    private $reclamations;

    /**
     * Set nomExp
     *
     * @param string $nomExp
     *
     * @return Expert
     */
    public function setNomExp($nomExp)
    {
        $this->nomExp = $nomExp;

        return $this;
    }

    /**
     * Get nomExp
     *
     * @return string
     */
    public function getNomExp()
    {
        return $this->nomExp;
    }

    /**
     * Set prenomExp
     *
     * @param string $prenomExp
     *
     * @return Expert
     */
    public function setPrenomExp($prenomExp)
    {
        $this->prenomExp = $prenomExp;

        return $this;
    }

    /**
     * Get prenomExp
     *
     * @return string
     */
    public function getPrenomExp()
    {
        return $this->prenomExp;
    }

    /**
     * Set zoneExp
     *
     * @param string $zoneExp
     *
     * @return Expert
     */
    public function setZoneExp($zoneExp)
    {
        $this->zoneExp = $zoneExp;

        return $this;
    }

    /**
     * Get zoneExp
     *
     * @return string
     */
    public function getZoneExp()
    {
        return $this->zoneExp;
    }

    /**
     * Set telExp
     *
     * @param integer $telExp
     *
     * @return Expert
     */
    public function setTelExp($telExp)
    {
        $this->telExp = $telExp;

        return $this;
    }

    /**
     * Get telExp
     *
     * @return integer
     */
    public function getTelExp()
    {
        return $this->telExp;
    }

    /**
     * @return string
     */
    public function getCinExp()
    {
        return $this->cinExp;
    }

    /**
     * @param string $cinExp
     */
    public function setCinExp($cinExp)
    {
        $this->cinExp = $cinExp;
    }

    /**
     * @return mixed
     */
    public function getRapports()
    {
        return $this->rapports;
    }

    /**
     * @param mixed $rapports
     */
    public function setRapports($rapports)
    {
        $this->rapports = $rapports;
    }

    /**
     * @return mixed
     */
    public function getReclamations()
    {
        return $this->reclamations;
    }

    /**
     * @param mixed $reclamations
     */
    public function setReclamations($reclamations)
    {
        $this->reclamations = $reclamations;
    }



}
