<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Constat
 *
 * @ORM\Table(name="constat")
 * @ORM\Entity
 */
class Constat extends Reclamation
{
    /**
     * @var string
     *
     * @ORM\Column(name="Croquis", type="blob", length=65535, nullable=false)
     */
    private $croquis;

    /**
     * @var string
     *
     * @ORM\Column(name="Matricule_autrui", type="string", length=255, nullable=false)
     */
    private $matriculeAutrui;

    /**
     * Set croquis
     *
     * @param string $croquis
     *
     * @return Constat
     */
    public function setCroquis($croquis)
    {
        $this->croquis = $croquis;

        return $this;
    }

    /**
     * Get croquis
     *
     * @return string
     */
    public function getCroquis()
    {
        return $this->croquis;
    }

    /**
     * Set matriculeAutrui
     *
     * @param string $matriculeAutrui
     *
     * @return Constat
     */
    public function setMatriculeAutrui($matriculeAutrui)
    {
        $this->matriculeAutrui = $matriculeAutrui;

        return $this;
    }

    /**
     * Get matriculeAutrui
     *
     * @return string
     */
    public function getMatriculeAutrui()
    {
        return $this->matriculeAutrui;
    }


}
