<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Prime RC
 *
 * @ORM\Table(name="primerc")
 * @ORM\Entity
 */
class PrimeRC
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
     * @var float
     *
     * @ORM\Column(name="puissance_fiscale", type="float", precision=10, scale=0, nullable=false)
     */
    private $puissanceFiscale;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=3, nullable=false)
     */
    private $prix;

    /**
     *@ORM\OneToMany(targetEntity="AppBundle\Entity\Vehicule",mappedBy="primeRC")
     */
    private $vehicules;
    /**
     * GarantieComplementaire constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
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
    public function getPuissanceFiscale()
    {
        return $this->puissanceFiscale;
    }

    /**
     * @param float $puissanceFiscale
     */
    public function setPuissanceFiscale($puissanceFiscale)
    {
        $this->puissanceFiscale = $puissanceFiscale;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
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


}
