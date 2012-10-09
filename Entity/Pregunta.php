<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\Grupo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Itsur\AeiBundle\Entity\Pregunta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pregunta
{
    const IDENTIFICAR ='IDENTIFICAR';
    const CONOCER ='CONOCER';
    const DOMINAR='APLICAR';

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var text $sentencia
     *
     * @ORM\Column(name="sentencia", type="text")
     */
    protected $sentencia;
    
    
    /**
     * @var string $objetivo
     *
     * @ORM\Column(name="objetivo", type="string", length=12)
     */
    protected $objetivo;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Grupo",inversedBy="preguntas")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    protected $grupo;

    /**
     * @var string $imagen
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    protected $imagen;
    
    
    /**
     * @var string $respuestaImagenes
     *
     * @ORM\Column(name="respuestaImagenes", type="boolean", nullable=true)
     */
    protected $respuestaImagenes;
    
     /**
     * @var string $opcion1
     *
     * @ORM\Column(name="opcion1", type="text")
     */
    protected $opcion1;


    /**
     * @var string $opcion2
     *
     * @ORM\Column(name="opcion2", type="text")
     */
    protected $opcion2;


    /**
     * @var string $opcion3
     *
     * @ORM\Column(name="opcion3", type="text")
     */
    protected $opcion3;


    /**
     * @var string $opcion4
     *
     * @ORM\Column(name="opcion4", type="text")
     */
    protected $opcion4;


    /**
     * @var text $respuesta
     *
     * @ORM\Column(name="respuesta", type="text")
     * @Assert\Null()
     */
    protected $respuesta;

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
     * Set sentencia
     *
     * @param text $sentencia
     */
    public function setSentencia($sentencia)
    {
        $this->sentencia = $sentencia;
    }

    /**
     * Get sentencia
     *
     * @return text 
     */
    public function getSentencia()
    {
        return $this->sentencia;
    }
    
    /**
     * Set objetivo
     *
     * @param string $objetivo
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;
    }

    /**
     * Get objetivo
     *
     * @return string
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set grupo
     *
     * @param Itsur\AeiBundle\Entity\Grupo $grupo
     */
    public function setGrupo(Grupo $grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * Get grupo
     *
     * @return Itsur\AeiBundle\Entity\Grupo 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set opcion1
     *
     * @param string $opcion1
     */
    public function setOpcion1($opcion1)
    {
        $this->opcion1 = $opcion1;
    }

    /**
     * Get opcion1
     *
     * @return string 
     */
    public function getOpcion1()
    {
        return $this->opcion1;
    }

    /**
     * Set opcion2
     *
     * @param string $opcion2
     */
    public function setOpcion2($opcion2)
    {
        $this->opcion2 = $opcion2;
    }

    /**
     * Get opcion2
     *
     * @return string 
     */
    public function getOpcion2()
    {
        return $this->opcion2;
    }

    /**
     * Set opcion3
     *
     * @param string $opcion3
     */
    public function setOpcion3($opcion3)
    {
        $this->opcion3 = $opcion3;
    }

    /**
     * Get opcion3
     *
     * @return string 
     */
    public function getOpcion3()
    {
        return $this->opcion3;
    }

    /**
     * Set opcion4
     *
     * @param string $opcion4
     */
    public function setOpcion4($opcion4)
    {
        $this->opcion4 = $opcion4;
    }

    /**
     * Get opcion4
     *
     * @return string 
     */
    public function getOpcion4()
    {
        return $this->opcion4;
    }

    /**
     * Set respuesta
     *
     * @param string $respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    }

    /**
     * Get respuesta
     *
     * @return string 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }
    
    /**
     * Set imagen
     *
     * @param string $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
    
    
    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }
    
    /**
     * Set respuestaImagenes
     *
     * @param true $respuestaImagenes
     */
    public function setRespuestaImagenes($respuestaImagenes)
    {
        $this->respuestaImagenes = $respuestaImagenes;
    }
    
    
    /**
     * Get respuestImagenes
     *
     * @return true
     */
    public function getRespuetaImagenes()
    {
        return $this->respuestaImagenes;
    }
    
    /**
     * Recupera la puntuación de la pregunta
     *
     */
    public function getPuntaje(){
        $puntaje = 0;
         if($this->getObjetivo() == Pregunta::IDENTIFICAR){
          $puntaje = 1;
        }elseif($this->getObjetivo() == Pregunta::CONOCER){
          $puntaje = 2;
        }elseif($this->getObjetivo() == Pregunta::DOMINAR){
          $puntaje = 3;
        }
        return $puntaje;
    }
}