<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\iEvaluable;
use Itsur\AeiBundle\Entity\GrupoEvaluable;
use Itsur\AeiBundle\Entity\SeccionEvaluable;
use Itsur\AeiBundle\Entity\Tema;
use \Itsur\AeiBundle\Entity\SeccionPeriodo;
use \Itsur\AeiBundle\Entity\TemaPeriodo;

/**
 * Itsur\AeiBundle\Entity\TemaEvaluable
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Itsur\AeiBundle\Repository\TemaEvaluableRepository")
 */
class TemaEvaluable implements iEvaluable
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
     * @var integer $puntaje
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
     *
     * @ORM\ManyToOne(targetEntity="SeccionEvaluable",inversedBy="temas")
     * @ORM\JoinColumn(name="seccionEvaluable_id", referencedColumnName="id")
     */
    protected $seccion;

    /**
     *
     * @ORM\OneToMany(targetEntity="GrupoEvaluable", mappedBy="tema", cascade={"persist", "merge"})
     * @ORM\OrderBy({"orden" = "ASC"})
     */
    protected $grupos;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Tema")
     * @ORM\JoinColumn(name="tema_id", referencedColumnName="id")
     */
    protected $tema;
    
    
    
    
    public function __construct()
    {
        $this->grupos = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set seccion
     *
     * @param Itsur\AeiBundle\Entity\SeccionEvaluable $seccion
     */
    public function setSeccion(SeccionEvaluable $seccion)
    {
        $this->seccion = $seccion;
    }

    /**
     * Get seccion
     *
     * @return Itsur\AeiBundle\Entity\SeccionEvaluable
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Add grupos
     *
     * @param Itsur\AeiBundle\Entity\GrupoEvaluable $grupos
     */
    public function addGrupoEvaluable(GrupoEvaluable $grupos)
    {
        $this->grupos[] = $grupos;
    }

    /**
     * Get grupos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGrupos()
    {
        return $this->grupos;
    }
    

    /**
     * Set tema
     *
     * @param Itsur\AeiBundle\Entity\Tema $tema
     */
    public function setTema(\Itsur\AeiBundle\Entity\Tema $tema)
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
    
    /**
     *Crea los GrupoEvalubles del TemaEvaluable
     *
     */
    public function crearGrupos(\Itsur\AeiBundle\Entity\TemaPeriodo $temaPeriodo){

        $posiciones = Utilerias::ordenAleatorio($temaPeriodo->getGrupos()->count());
        $posicion = 0;
        
        foreach($temaPeriodo->getGrupos() as $grupo =>$grupoPeriodo){

          $ge = new GrupoEvaluable();
          $ge->setOrden($posiciones[$posicion]);
          $ge->setTema($this);
          $ge->setGrupo($grupoPeriodo->getGrupo());
          $ge->setPuntaje(0);
          $ge->setCalificacion(0);
          $ge->setContestada(false);
          $posicion++;
          
          $this->addGrupoEvaluable($ge);
          $ge->crearPreguntas($grupoPeriodo);
        }

    }
    
    /**
     * Get a calification
     *
     * @return a integer
     */
    public function evaluar() {
        $this->puntaje = 0;

       foreach($this->grupos as $grupo){
           $grupo->evaluar();
           $this->puntaje  = $this->puntaje  + $grupo->getPuntaje();
       }

       $this->calificacion = round(($this->puntaje * 100)/ $this->tema->getPuntaje(),2);

       return $this->puntaje;
    }
}