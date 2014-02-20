<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\iEvaluable;
use Itsur\AeiBundle\Entity\HojaRespuestas;
use Itsur\AeiBundle\Entity\AreaEvaluable;
use Itsur\AeiBundle\Entity\Aspirante;
use Itsur\AeiBundle\Entity\Manual;
use Itsur\AeiBundle\Entity\ManualPeriodo;
use Itsur\AeiBundle\Entity\AreaPeriodo;

/**
 * Itsur\AeiBundle\Entity\HojaRespuestas
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Itsur\AeiBundle\Repository\HojaRespuestasRepository")
 */
class HojaRespuestas  implements iEvaluable
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
     * @var datetime $fecha
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    protected $fecha;

    /**
     * @var integer $calificacion
     *
     * @ORM\Column(name="calificacion", type="decimal")
     */
    protected $calificacion;
    
    /**
     * @var integer $puntaje
     *
     * @ORM\Column(name="puntuaje", type="integer", nullable="true")
     */
    protected $puntaje;
    
    /**
     * @var integer $calificacionSeleccion
     *
     * @ORM\Column(name="calificacionSeleccion", nullable="true", type="decimal")
     */
    protected $calificacionSeleccion;
    
    /**
     * @var integer $puntajeSeleccion
     *
     * @ORM\Column(name="puntuajeSeleccion", type="integer", nullable="true")
     */
    protected $puntajeSeleccion;

    /**
     * @var integer $calificacionDiagnostico
     *
     * @ORM\Column(name="calificacionDiagnostico", nullable="true", type="decimal", scale=2)
     */
    protected $calificacionDiagnostico;
    
    /**
     * @var integer $puntajeDiagnostico
     *
     * @ORM\Column(name="puntajeDiagnostico", type="integer", nullable="true")
     */
    protected $puntajeDiagnostico;
    

    /**
     * @var string $aplicador
     *
     * @ORM\Column(name="aplicador", type="string", length=255)
     */
    protected $aplicador;


    /**
     *
     * @ORM\OneToOne(targetEntity="Aspirante", inversedBy="hoja")
     * @ORM\JoinColumn(name="aspirante_id", referencedColumnName="id")
     */
    protected $aspirante;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Periodo")
     * @ORM\JoinColumn(name="periodo_id", referencedColumnName="id")
     */
    protected $periodo;
    

    /**
     *
     * @ORM\OneToMany(targetEntity="AreaEvaluable", mappedBy="hoja", cascade={"persist", "merge"})
     * @ORM\OrderBy({"orden" = "ASC"})
     */
    protected $areas;


     /**
     *
     * @ORM\ManyToOne(targetEntity="Manual")
     * @ORM\JoinColumn(name="manual_id", referencedColumnName="id")
     */
    protected $manual;
    
    

    public function __construct()
    {
        $this->areas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fecha
     *
     * @param datetime $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return datetime 
     */
    public function getFecha()
    {
        return $this->fecha;
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
     * Set calificacionSeleccion
     *
     * @param decimal $calificacionSeleccion
     */
    public function setCalificacionSeleccion($calificacionSeleccion)
    {
        $this->calificacionSeleccion = $calificacionSeleccion;
    }

    /**
     * Get calificacionSeleccion
     *
     * @return decimal
     */
    public function getCalificacionSeleccion()
    {
        return $this->calificacionSeleccion;
    }
    
    /**
     * Set puntajeSeleccion
     *
     * @param integer $puntaje
     */
    public function setPuntajeSeleccion($puntajeSeleccion)
    {
        $this->puntajeSeleccion = $puntajeSeleccion;
    }

    /**
     * Get puntajeSeleccion
     *
     * @return integer
     */
    public function getPuntajeSeleccion()
    {
        return $this->puntajeSeleccion;
    }


    /**
     * Set calificacionDiagnostico
     *
     * @param decimal $calificacionDiagnostico
     */
    public function setCalificacionDiagnostico($calificacionDiagnostico)
    {
        $this->calificacionDiagnostico = $calificacionDiagnostico;
    }

    /**
     * Get calificacionDiagnostico
     *
     * @return decimal
     */
    public function getCalificacionDiagnostico()
    {
        return $this->calificacionDiagnostico;
    }
    
    
    /**
     * Set puntajeDiagnostico
     *
     * @param integer $puntajeDiagnostico
     */
    public function setPuntajeDiagnostico($puntajeDiagnostico)
    {
        $this->puntajeDiagnostico = $puntajeDiagnostico;
    }

    /**
     * Get puntajeDiagnostico
     *
     * @return integer
     */
    public function getPuntajeDiagnostico()
    {
        return $this->puntajeDiagnostico;
    }
    
    

    /**
     * Set aplicador
     *
     * @param string $aplicador
     */
    public function setAplicador($aplicador)
    {
        $this->aplicador = $aplicador;
    }

    /**
     * Get aplicador
     *
     * @return string 
     */
    public function getAplicador()
    {
        return $this->aplicador;
    }

    /**
     * Add areas
     *
     * @param Itsur\AeiBundle\Entity\AreaEvaluable $areas
     */
    public function addAreaEvaluable(AreaEvaluable $areas)
    {
        $this->areas[] = $areas;
    }

    /**
     * Get areas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAreas()
    {
        return $this->areas;
    }

    /**
     * Set aspirante
     *
     * @param Itsur\AeiBundle\Entity\Aspirante $aspirante
     */
    public function setAspirante(Aspirante $aspirante)
    {
        $this->aspirante = $aspirante;
    }

    /**
     * Get aspirante
     *
     * @return Itsur\AeiBundle\Entity\Aspirante 
     */
    public function getAspirante()
    {
        return $this->aspirante;
    }
    
    /**
     * Set maual
     *
     * @param Itsur\AeiBundle\Entity\Manual $maual
     */
    public function setManual(Manual $manual)
    {
        $this->manual = $manual;
    }

    /**
     * Get maual
     *
     * @return Itsur\AeiBundle\Entity\Manual 
     */
    public function getManual()
    {
        return $this->manual;
    }

    /**
     * Set periodo
     *
     * @param Itsur\AeiBundle\Entity\Periodo $periodo
     */
    public function setPeriodo(\Itsur\AeiBundle\Entity\Periodo $periodo)
    {
        $this->periodo = $periodo;
    }

    /**
     * Get periodo
     *
     * @return Itsur\AeiBundle\Entity\Periodo 
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }
    
     /**
     * Crea las areas evaluables del objeto hoja.
     */
    public function crearAreas(\Itsur\AeiBundle\Entity\ManualPeriodo $manualPeriodo){
      $posiciones = Utilerias::ordenAleatorio($manualPeriodo->getAreas()->count());
      $posicion = 0;

      foreach($manualPeriodo->getAreas()as $area =>$areaPeriodo){
          $ae = new AreaEvaluable();
          $ae->setOrden($posiciones[$posicion]);
          $ae->setHoja($this);
          $ae->setArea($areaPeriodo->getArea());
          $ae->setTiempo(0);
          $ae->setPuntaje(0);
          $ae->setCalificacion(0);
          $ae->setContestada(false);
          $posicion++;
          
          $this->addAreaEvaluable($ae);
          $ae->crearSecciones($areaPeriodo);

      }

    }
    
    /**
     * Get a calification
     *
     * @return a integer
     */
    public function evaluar() {
       $this->puntaje=0;
       $this->puntajeDiagnostico =0;
       $this->puntajeSeleccion =0;
       
       foreach($this->areas as $area){
           $area->evaluar();
           
           $this->puntaje = $this->puntaje + $area->getPuntaje();
           $this->puntajeDiagnostico = $this->puntajeDiagnostico + $area->getPuntajeDiagnostico();
           $this->puntajeSeleccion = $this->puntajeSeleccion + $area->getPuntajeSeleccion();
       }
       
       $this->calificacion= round(($this->puntaje * 100) / $this->manual->getPuntaje(),2);
       $this->calificacionDiagnostico = round(($this->puntajeDiagnostico * 100) / $this->manual->getPuntajeDiagnostico(),2);
       $this->calificacionSeleccion = round(($this->puntajeSeleccion * 100) / $this->manual->getPuntajeSeleccion(),2);

       
       return $this->calificacion;
    }
}