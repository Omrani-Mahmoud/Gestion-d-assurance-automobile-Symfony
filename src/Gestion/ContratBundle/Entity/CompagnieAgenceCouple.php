<?php

namespace Gestion\ContratBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class CompagnieAgenceCouple
{
    private $compagnie;
    private $agences;

    /**
     * CompagnieAgenceCouple constructor.
     * @param $compagnie
     * @param $agences
     */
    public function __construct($compagnie)
    {
        $this->compagnie = $compagnie;
        $this->agences = new ArrayCollection();
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
    public function getAgences()
    {
        return $this->agences;
    }

    /**
     * @param mixed $agences
     */
    public function setAgence($agences)
    {
        $this->agences = $agences;
    }


}