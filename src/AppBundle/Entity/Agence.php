<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity
 */
class Agence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="zone", type="string", length=150, nullable=false)
     */
    private $zone;

    /**
     * @var integer
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_employer", type="integer", nullable=false)
     */
    private $nbrEmployer;

    /**
     * @var integer
     *
     * @ORM\Column(name="fax", type="integer", nullable=false)
     */
    private $fax;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Compagnie",inversedBy="agences")
     */
    private $compagnie;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Police",mappedBy="agence")
     */
    private $contrats;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Agent",mappedBy="agence",cascade={"persist"})
     */
    private $agents;

    /**
     * Set zone
     *
     * @param string $zone
     *
     * @return Agence
     */
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Agence
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set nbrEmployer
     *
     * @param integer $nbrEmployer
     *
     * @return Agence
     */
    public function setNbrEmployer($nbrEmployer)
    {
        $this->nbrEmployer = $nbrEmployer;

        return $this;
    }

    /**
     * Get nbrEmployer
     *
     * @return integer
     */
    public function getNbrEmployer()
    {
        return $this->nbrEmployer;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     *
     * @return Agence
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
     * Set compagnie
     *
     * @param integer $compagnie
     *
     * @return Agence
     */
    public function setCompagnie($compagnie)
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    /**
     * Get compagnie
     *
     * @return integer
     */
    public function getCompagnie()
    {
        return $this->compagnie;
    }

    /**
     * Get idAgence
     *
     * @return integer
     */
    public function getIdAgence()
    {
        return $this->id;
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

    /**
     * @return mixed
     */
    public function getAgents()
    {
        return $this->agents;
    }

    /**
     * @param mixed $agents
     */
    public function setAgents($agents)
    {
        $this->agents = $agents;
    }


}
