<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CourtierCompagnie
 *
 * @ORM\Table(name="courtier_compagnie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourtierCompagnieRepository")
 */
class CourtierCompagnie
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Compagnie", inversedBy="CourtierCompagnie")
     * @ORM\Id
     */
    private $compagnie;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Courtier", inversedBy="CourtierCompagnie")
     * @ORM\Id
     */
    private $courtier;

    /**
     * @var bool
     *
     * @ORM\Column(name="accept", type="boolean")
     */
    private $accept = false;

    /**
     * @return bool
     */
    public function isAccept()
    {
        return $this->accept;
    }

    /**
     * @param bool $accept
     */
    public function setAccept($accept)
    {
        $this->accept = $accept;
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
    public function getCourtier()
    {
        return $this->courtier;
    }

    /**
     * @param mixed $Courtier
     */
    public function setCourtier($Courtier)
    {
        $this->courtier = $Courtier;
    }
}

