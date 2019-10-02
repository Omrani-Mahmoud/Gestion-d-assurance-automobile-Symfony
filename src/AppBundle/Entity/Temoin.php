<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Temoin
 *
 * @ORM\Table(name="temoin")
 * @ORM\Entity
 */
class Temoin
{
    /**
     * @var string
     *
     * @ORM\Column(name="CinT", type="string", length=8, nullable=false)
     * @ORM\Id
     */
    private $cint;

    /**
     * @var string
     *
     * @ORM\Column(name="NomT", type="string", length=20, nullable=false)
     */
    private $nomt;

    /**
     * @var string
     *
     * @ORM\Column(name="PrenomT", type="string", length=20, nullable=false)
     */
    private $prenomt;

    /**
     * @var string
     *
     * @ORM\Column(name="TelT", type="string", length=20, nullable=false)
     */
    private $telt;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=1000, nullable=true)
     */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sinistre",inversedBy="temoins")
     * @ORM\JoinColumn(referencedColumnName="code")
     */
    private $sinistre;

    /**
     * Set nomt
     *
     * @param string $nomt
     *
     * @return Temoin
     */
    public function setNomt($nomt)
    {
        $this->nomt = $nomt;

        return $this;
    }

    /**
     * Get nomt
     *
     * @return string
     */
    public function getNomt()
    {
        return $this->nomt;
    }

    /**
     * Set prenomt
     *
     * @param string $prenomt
     *
     * @return Temoin
     */
    public function setPrenomt($prenomt)
    {
        $this->prenomt = $prenomt;

        return $this;
    }

    /**
     * Get prenomt
     *
     * @return string
     */
    public function getPrenomt()
    {
        return $this->prenomt;
    }

    /**
     * Set telt
     *
     * @param string $telt
     *
     * @return Temoin
     */
    public function setTelt($telt)
    {
        $this->telt = $telt;

        return $this;
    }

    /**
     * Get telt
     *
     * @return string
     */
    public function getTelt()
    {
        return $this->telt;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Temoin
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
     * Get cint
     *
     * @return string
     */
    public function getCint()
    {
        return $this->cint;
    }

    /**
     * Set cint
     *
     * @param string $cint
     *
     * @return Temoin
     */
    public function setCint($cint)
    {
        $this->cint = $cint;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSinistre()
    {
        return $this->sinistre;
    }

    /**
     * @param mixed $sinistre
     */
    public function setSinistre($sinistre)
    {
        $this->sinistre = $sinistre;
    }


}
