<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Itsur\AeiBundle\Entity\iEvaluable;
use Itsur\AeiBundle\Entity\GrupoEvaluable;
use Itsur\AeiBundle\Entity\Pregunta;

/**
 * Itsur\AeiBundle\Entity\PreguntaEvaluable
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PreguntaEvaluable  implements iEvaluable
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
     * @var integer $orden
     *
     * @ORM\Column(name="orden", type="integer")
     */
    protected $orden;

    /**
     * @var text $respuesta
     *
     * @ORM\Column(name="respuesta", type="text", nullable=true)
     * @Assert\Null()
     */
    protected $respuesta;

    /**
     * @var boolean $contestada
     *
     * @ORM\Column(name="contestada", type="boolean")
     */
    protected $contestada;


     /**
     *
     * @ORM\ManyToOne(targetEntity="GrupoEvaluable",inversedBy="preguntas")
     * @ORM\JoinColumn(name="grupoevaluable_id", referencedColumnName="id")
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
     * Set orden
     *
     * @param integer $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set respuesta
     *
     * @param text $respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    }

    /**
     * Get respuesta
     *
     * @return text 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set contestada
     *
     * @param boolean $contestada
     */
    public function setContestada($contestada)
    {
        $this->contestada = $contestada;
    }

    /**
     * Get contestada
     *
     * @return boolean 
     */
    public function getContestada()
    {
        return $this->contestada;
    }

    /**
     * Set grupo
     *
     * @param Itsur\AeiBundle\Entity\GrupoEvaluable $grupo
     */
    public function setGrupo(GrupoEvaluable $grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * Get grupo
     *
     * @return Itsur\AeiBundle\Entity\GrupoEvaluable 
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
    
    /**
     * Get a calification
     *
     * @return a integer
     */
    public function evaluar() {
        $acierto=0;

        $elejida =  $this->getRespuesta();
        $correcta = $this->pregunta->getRespuesta();

        if( $elejida == $correcta ){
          $acierto = 1;
        }
        return $acierto * $this->pregunta->getPuntaje();
    }
    
}