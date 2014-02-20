<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\iEvaluable;
use Itsur\AeiBundle\Entity\TemaEvaluable;
use Itsur\AeiBundle\Entity\PreguntaEvaluable;
use \Itsur\AeiBundle\Entity\GrupoPeriodo;

/**
 * Itsur\AeiBundle\Entity\GrupoEvaluable
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Itsur\AeiBundle\Repository\GrupoEvaluableRepository")
 */
class GrupoEvaluable  implements iEvaluable
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
     * @var integer $calificacion
     *
     * @ORM\Column(name="calificacion", type="decimal", scale=2)
     */
    protected $calificacion;
    
    /**
     * @var integer $puntuacion
     *
     * @ORM\Column(name="puntuaje", type="integer", nullable="true")
     */
    protected $puntaje;

    /**
     * @var boolean $contestada
     *
     * @ORM\Column(name="contestada", type="boolean")
     */
    protected $contestada;

     /**
     * @ORM\ManyToOne(targetEntity="TemaEvaluable",inversedBy="grupos")
     * @ORM\JoinColumn(name="temaEvaluable_id", referencedColumnName="id")
     */
    protected $tema;

    /**
     *
     * @ORM\OneToMany(targetEntity="PreguntaEvaluable", mappedBy="grupo", cascade={"persist", "merge"})
     * @ORM\OrderBy({"orden" = "ASC"})
     */
    protected $preguntas;
    
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Grupo")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    protected $grupo;

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
     * Set calificacion
     *
     * @param decimal $calificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    /**
     * Get calificacion
     *
     * @return decimal
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }
    
    /**
     * Set puntaje
     *
     * @param integer $puntaje
     */
    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;
    }

    /**
     * Get puntaje
     *
     * @return integer
     */
    public function getPuntaje()
    {
        return $this->puntaje;
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
    


    public function __construct()
    {
        $this->preguntas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set tema
     *
     * @param Itsur\AeiBundle\Entity\TemaEvaluable $tema
     */
    public function setTema(TemaEvaluable $tema)
    {
        $this->tema = $tema;
    }

    /**
     * Get tema
     *
     * @return Itsur\AeiBundle\Entity\TemaEvaluable
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Add preguntas
     *
     * @param Itsur\AeiBundle\Entity\PreguntaEvaluable $preguntas
     */
    public function addPregunta(PreguntaEvaluable $preguntas)
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

    /**
     * Set grupo
     *
     * @param Itsur\AeiBundle\Entity\Grupo $grupo
     */
    public function setGrupo(\Itsur\AeiBundle\Entity\Grupo $grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * Add preguntas
     *
     * @param Itsur\AeiBundle\Entity\PreguntaEvaluable $preguntas
     */
    public function addPreguntaEvaluable(\Itsur\AeiBundle\Entity\PreguntaEvaluable $preguntas)
    {
        $this->preguntas[] = $preguntas;
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
     *Crea las PreguntaEvalubles del GrupoEvaluable
     *
     */
    public function crearPreguntas(\Itsur\AeiBundle\Entity\GrupoPeriodo $grupoPeriodo){
        $posicion = 1;

        foreach($grupoPeriodo->getPreguntas() as $pregunta =>$preguntaPeriodo){

          $pe = new PreguntaEvaluable();
          $pe->setOrden($posicion);
          $pe->setGrupo($this);
          $pe->setPregunta($preguntaPeriodo->getPregunta());
          //$pe->setCalificacion(0);
          $pe->setContestada(false);
          $posicion++;

          $this->addPreguntaEvaluable($pe);
        }

    }

    /**
     * Get a calification
     *
     * @return a integer
     */
    public function evaluar() {
        $this->puntaje = 0;

       foreach($this->preguntas as $pregunta){
           $this->puntaje = $this->puntaje + $pregunta->evaluar();
       }

       $this->calificacion = round(($this->puntaje *  100 ) / $this->grupo->getPuntaje(),2) ;

       return $this->puntaje;
    }
}