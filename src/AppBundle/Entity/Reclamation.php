<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 * @ORM\InheritanceType(value="JOINED")
 * @Vich\Uploadable
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="code_rec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeRec;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rec", type="date", nullable=false)
     */
    private $dateRec;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_rec", type="string", length=50, nullable=false)
     */
    private $lieuRec;

    /**
     * @var string
     *
     * @ORM\Column(name="objet_rec", type="string", length=50, nullable=false)
     */
    private $objetRec;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire_rec", type="string", length=1000, nullable=false)
     */
    private $commentaireRec;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Sinistre", mappedBy="reclamation")
     * @ORM\JoinColumn(referencedColumnName="code")
     */
    private $codeSinistre;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_rap", type="string", nullable=true)
     */
    private $titreRap;

    /**
     * @var string
     *
     * @ORM\Column(name="detaille_rap", type="string", nullable=true)
     */
    private $detailleRap;

    /**
     * @Vich\UploadableField(mapping="rapport_image", fileNameProperty="imageName")
     * @var File
     */
    private $documentRap;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $imageName;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rap", type="date", nullable=true)
     */
    private $dateRap;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temp_rap", type="time", nullable=true)
     */
    private $tempRap;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Expert", inversedBy="reclamations")
     */
    private $expert;

    /**
     * Set dateRec
     *
     * @param \DateTime $dateRec
     *
     * @return Reclamation
     */
    public function setDateRec($dateRec)
    {
        $this->dateRec = $dateRec;

        return $this;
    }

    /**
     * Get dateRec
     *
     * @return \DateTime
     */
    public function getDateRec()
    {
        return $this->dateRec;
    }

    /**
     * Set lieuRec
     *
     * @param string $lieuRec
     *
     * @return Reclamation
     */
    public function setLieuRec($lieuRec)
    {
        $this->lieuRec = $lieuRec;

        return $this;
    }

    /**
     * Get lieuRec
     *
     * @return string
     */
    public function getLieuRec()
    {
        return $this->lieuRec;
    }

    /**
     * Set objetRec
     *
     * @param string $objetRec
     *
     * @return Reclamation
     */
    public function setObjetRec($objetRec)
    {
        $this->objetRec = $objetRec;

        return $this;
    }

    /**
     * Get objetRec
     *
     * @return string
     */
    public function getObjetRec()
    {
        return $this->objetRec;
    }

    /**
     * Set commentaireRec
     *
     * @param string $commentaireRec
     *
     * @return Reclamation
     */
    public function setCommentaireRec($commentaireRec)
    {
        $this->commentaireRec = $commentaireRec;

        return $this;
    }

    /**
     * Get commentaireRec
     *
     * @return string
     */
    public function getCommentaireRec()
    {
        return $this->commentaireRec;
    }

    /**
     * Set codeSinistre
     *
     * @param integer $codeSinistre
     *
     * @return Reclamation
     */
    public function setCodeSinistre($codeSinistre)
    {
        $this->codeSinistre = $codeSinistre;

        return $this;
    }

    /**
     * Get codeSinistre
     *
     * @return integer
     */
    public function getCodeSinistre()
    {
        return $this->codeSinistre;
    }

    /**
     * Get codeRec
     *
     * @return integer
     */
    public function getCodeRec()
    {
        return $this->codeRec;
    }

    /**
     * @return mixed
     */
    public function getRapport()
    {
        return $this->rapport;
    }

    /**
     * @param mixed $rapport
     */
    public function setRapport($rapport)
    {
        $this->rapport = $rapport;
    }

    /**
     * @param mixed $rapport
     */
    public function setCodeRec($codeRec)
    {
        $this->codeRec = $codeRec;
    }

    /**
     * @return string
     */
    public function getTitreRap()
    {
        return $this->titreRap;
    }

    /**
     * @param string $titreRap
     */
    public function setTitreRap($titreRap)
    {
        $this->titreRap = $titreRap;
    }

    /**
     * @return string
     */
    public function getDetailleRap()
    {
        return $this->detailleRap;
    }

    /**
     * @param string $detailleRap
     */
    public function setDetailleRap($detailleRap)
    {
        $this->detailleRap = $detailleRap;
    }

    /**
     * @return File
     */
    public function getDocumentRap()
    {
        return $this->documentRap;
    }

    /**
     * @param File $documentRap
     */
    public function setDocumentRap(File $documentRap = null)
    {
        $this->documentRap = $documentRap;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return \DateTime
     */
    public function getDateRap()
    {
        return $this->dateRap;
    }

    /**
     * @param \DateTime $dateRap
     */
    public function setDateRap($dateRap)
    {
        $this->dateRap = $dateRap;
    }

    /**
     * @return \DateTime
     */
    public function getTempRap()
    {
        return $this->tempRap;
    }

    /**
     * @param \DateTime $tempRap
     */
    public function setTempRap($tempRap)
    {
        $this->tempRap = $tempRap;
    }

    /**
     * @return mixed
     */
    public function getExpert()
    {
        return $this->expert;
    }

    /**
     * @param mixed $expert
     */
    public function setExpert($expert)
    {
        $this->expert = $expert;
    }



}
