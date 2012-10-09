<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\Tema;
use Itsur\AeiBundle\Entity\Pregunta;

/**
 * Itsur\AeiBundle\Entity\Grupo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Grupo
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
     * @var integer $puntaje
     *
     * @ORM\Column(name="puntuaje", type="integer", nullable="true")
     */
    protected $puntaje;

    /**
     * @var text $instrucciones
     *
     * @ORM\Column(name="instrucciones", type="text", nullable="true")
     */
    protected $instrucciones;

    /**
     * @var text $caso
     *
     * @ORM\Column(name="caso", type="text", nullable="true")
     */
    protected $caso;

    /**
     * @var integer $cantidadPreguntas
     *
     * @ORM\Column(name="cantidadPreguntas", type="integer")
     */
    protected $cantidadPreguntas;

     /**
     * @ORM\ManyToOne(targetEntity="Tema",inversedBy="grupos")
     * @ORM\JoinColumn(name="tema_id", referencedColumnName="id")
     */
    protected $tema;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Pregunta", mappedBy="grupo")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    protected $preguntas;
    

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
     * Set puntaje
     *
     * @param decimal $puntaje
     */
    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;
    }

    /**
     * Get puntaje
     *
     * @return decimal
     */
    public function getPuntaje()
    {
        return $this->puntaje;
    }

    /**
     * Set instrucciones
     *
     * @param text $instrucciones
     */
    public function setInstrucciones($instrucciones)
    {
        $this->instrucciones = $instrucciones;
    }

    /**
     * Get instrucciones
     *
     * @return text 
     */
    public function getInstrucciones()
    {
        return $this->instrucciones;
    }

    /**
     * Set caso
     *
     * @param text $caso
     */
    public function setCaso($caso)
    {
        $this->caso = $caso;
    }

    /**
     * Get caso
     *
     * @return text 
     */
    public function getCaso()
    {
        return $this->caso;
    }

    /**
     * Set cantidadPreguntas
     *
     * @param integer $cantidadPreguntas
     */
    public function setCantidadPreguntas($cantidadPreguntas)
    {
        $this->cantidadPreguntas = $cantidadPreguntas;
    }

    /**
     * Get cantidadPreguntas
     *
     * @return integer 
     */
    public function getCantidadPreguntas()
    {
        return $this->cantidadPreguntas;
    }

    /**
     * Set tema
     *
     * @param Itsur\AeiBundle\Entity\Tema $tema
     */
    public function setTema(Tema $tema)
    {
        $this->tema = $tema;
    }

    /**
     * Get tema
     *
     * @return Itsur\AeiBundle\Entity\Tema
     */
    public function getTema()
    {
        return $this->tema;
    }
    public function __construct()
    {
        $this->preguntas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add preguntas
     *
     * @param Itsur\AeiBundle\Entity\Pregunta $preguntas
     */
    public function addPregunta(Pregunta $preguntas)
    {
        $this->preguntas[] = $preguntas;
    }

    /**
     * Get preguntas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }
}