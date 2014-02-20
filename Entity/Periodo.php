<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Itsur\AeiBundle\Entity\Periodo
 *
 * @ORM\Table(name="Periodo")
 * @ORM\Entity
 */
class Periodo
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $semestre
     *
     * @ORM\Column(name="semestre", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $semestre;

    /**
     * @var integer $anio
     *
     * @ORM\Column(name="anio", type="integer")
     * @Assert\NotBlank()
     */
    protected $anio;


    /**
     *
     * @ORM\OneToMany(targetEntity="Aspirante", mappedBy="periodo")
     */
    protected $aspirantes;


    /**
     *
     * @ORM\OneToOne(targetEntity="ManualPeriodo", mappedBy="periodo")
     */
    protected $manual;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set semestre
     *
     * @param string $semestre
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;
    }

    /**
     * Get semestre
     *
     * @return string 
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Set anio
     *
     * @param integer $anio
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;
    }

    /**
     * Get anio
     *
     * @return integer 
     */
    public function getAnio()
    {
        return $this->anio;
    }
    public function __construct()
    {
        $this->aspirantes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add aspirantes
     *
     * @param Itsur\AeiBundle\Entity\Aspirante $aspirantes
     */
    public function addAspirante(\Itsur\AeiBundle\Entity\Aspirante $aspirantes)
    {
        $this->aspirantes[] = $aspirantes;
    }

    /**
     * Get aspirantes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAspirantes()
    {
        return $this->aspirantes;
    }

    /**
     * Set manual
     *
     * @param Itsur\AeiBundle\Entity\ManualPeriodo $manual
     */
    public function setManual(ManualPeriodo $manual)
    {
        $this->manual = $manual;
    }

    /**
     * Get manual
     *
     * @return Itsur\AeiBundle\Entity\ManualPeriodo 
     */
    public function getManual()
    {
        return $this->manual;
    }
}