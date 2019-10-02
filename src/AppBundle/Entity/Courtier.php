<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as FOSUser;

/**
 * Courtier
 *
 * @ORM\Entity
 */
class Courtier extends User
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=50, nullable=false)
     */
    private $lieu;

    /**
     * @var float
     *
     * @ORM\Column(name="commission", type="float", precision=10, scale=0, nullable=false)
     */
    private $commission;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CourtierCompagnie", mappedBy="courtier")
     */
    private $CourtierCompagnie;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Courtier
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Courtier
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set commission
     *
     * @param float $commission
     *
     * @return Courtier
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * Get commission
     *
     * @return float
     */
    public function getCommission()
    {
        return $this->commission;
    }
}
