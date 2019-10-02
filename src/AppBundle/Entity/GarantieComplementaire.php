<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GarantieComplementaire
 *
 * @ORM\Table(name="garantie_complementaire")
 * @ORM\Entity
 */
class GarantieComplementaire
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
     * @var float
     *
     * @ORM\Column(name="tarif_de_base", type="float", precision=10, scale=0, nullable=true)
     */
    private $tarifDeBase;

    /**
     * @var float
     *
     * @ORM\Column(name="niv_franchise", type="float", precision=10, scale=0, nullable=true)
     */
    private $nivFranchise;

    /**
     * @var float
     *
     * @ORM\Column(name="prime_de_base", type="float", precision=10, scale=0, nullable=true)
     */
    private $primeDeBase;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string",length=250, nullable=true)
     */
    private $nom;
    /**
     * @var float
     *
     * @ORM\Column(name="surprime", type="float", precision=10, scale=0, nullable=true)
     */
    private $surprime;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Compagnie", inversedBy="garantis")
     */
    private $compagnie;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Police", inversedBy="garantis")
     * @ORM\JoinTable(name="police_garantis")
     */
    private $contrat;

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
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return float
     */
    public function getTarifDeBase()
    {
        return $this->tarifDeBase;
    }

    /**
     * @param float $tarifDeBase
     */
    public function setTarifDeBase($tarifDeBase)
    {
        $this->tarifDeBase = $tarifDeBase;
    }

    /**
     * @return float
     */
    public function getNivFranchise()
    {
        return $this->nivFranchise;
    }

    /**
     * @param float $nivFranchise
     */
    public function setNivFranchise($nivFranchise)
    {
        $this->nivFranchise = $nivFranchise;
    }

    /**
     * @return float
     */
    public function getPrimeDeBase()
    {
        return $this->primeDeBase;
    }

    /**
     * @param float $primeDeBase
     */
    public function setPrimeDeBase($primeDeBase)
    {
        $this->primeDeBase = $primeDeBase;
    }

    /**
     * @return float
     */
    public function getSurprime()
    {
        return $this->surprime;
    }

    /**
     * @param float $surprime
     */
    public function setSurprime($surprime)
    {
        $this->surprime = $surprime;
    }

    /**
     * @return mixed
     */
    public function getCompagnie()
    {
        return $this->compagnie;
    }

    /**
     * @param mixed $compagnie
     */
    public function setCompagnie($compagnie)
    {
        $this->compagnie = $compagnie;
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


}
