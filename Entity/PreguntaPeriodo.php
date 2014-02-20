<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\GrupoEvaluable;
use Itsur\AeiBundle\Entity\Pregunta;

/**
 * Itsur\AeiBundle\Entity\PreguntaPeriodo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PreguntaPeriodo
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
     *
     * @ORM\ManyToOne(targetEntity="GrupoPeriodo",inversedBy="preguntas")
     * @ORM\JoinColumn(name="grupoPeriodo_id", referencedColumnName="id")
     */
    protected $grupo;
    
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Pregunta")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id")
     */
    protected $pregunta;
    
    
    public function __construct()
    {
        $this->respuesta ="";
    }
    
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
     * Set grupo
     *
     * @param Itsur\AeiBundle\Entity\GrupoPeriodo $grupo
     */
    public function setGrupo(GrupoPeriodo $grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * Get grupo
     *
     * @return Itsur\AeiBundle\Entity\GrupoPeriodo 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }
    


    /**
     * Set pregunta
     *
     * @param Itsur\AeiBundle\Entity\Pregunta $pregunta
     */
    public function setPregunta(\Itsur\AeiBundle\Entity\Pregunta $pregunta)
    {
        $this->pregunta = $pregunta;
    }

    /**
     * Get pregunta
     *
     * @return Itsur\AeiBundle\Entity\Pregunta 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }   
}