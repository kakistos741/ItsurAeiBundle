<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\iEvaluable;
use Itsur\AeiBundle\Entity\HojaRespuestas;
use Itsur\AeiBundle\Entity\SeccionEvaluable;
use Itsur\AeiBundle\Entity\Seccion;
use Itsur\AeiBundle\Entity\Area;
use Itsur\AeiBundle\Entity\AreaPeriodo;

/**
 * Itsur\AeiBundle\Entity\AreaEvaluable
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Itsur\AeiBundle\Repository\AreaEvaluableRepository")
 */
class AreaEvaluable  implements iEvaluable
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
     * @var integer $tiempo
     *
     * @ORM\Column(name="tiempo", type="integer")
     */
    protected $tiempo;

    /**
     * @var decimal $calificacion
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
     * @var decimal $calificacionSeleccion
     *
     * @ORM\Column(name="calificacionSeleccion", nullable="true", type="decimal", scale=2)
     */
    protected $calificacionSeleccion;
    
    /**
     * @var integer $puntajeSeleccion
     *
     * @ORM\Column(name="puntuajeSeleccion", type="integer", nullable="true")
     */
    protected $puntajeSeleccion;
    
    /**
     * @var decimal $calificacionDiagnostico
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
     * @var boolean $contestada
     *
     * @ORM\Column(name="contestada", type="boolean")
     */
    protected $contestada;

     /**
     *
     * @ORM\ManyToOne(targetEntity="HojaRespuestas",inversedBy="areas")
     * @ORM\JoinColumn(name="hoja_id", referencedColumnName="id")
     */
    protected $hoja;

    /**
     *
     * @ORM\OneToMany(targetEntity="SeccionEvaluable", mappedBy="area", cascade={"persist", "merge"})
     * @ORM\OrderBy({"orden" = "ASC"})
     */
    protected $secciones;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Area")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    protected $area;
    

    public function __construct()
    {
        $this->temas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tiempo
     *
     * @param integer $tiempo
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;
    }

    /**
     * Get tiempo
     *
     * @return integer 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set calificacion
     *
     * @param integer $calificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    /**
     * Get calificacion
     *
     * @return integer 
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
     * @param integer $calificacionSeleccion
     */
    public function setCalificacionSeleccion($calificacionSeleccion)
    {
        $this->calificacionSeleccion = $calificacionSeleccion;
    }

    /**
     * Get calificacionSeleccion
     *
     * @return integer
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
     * @param integer $calificacionDiagnostico
     */
    public function setCalificacionDiagnostico($calificacionDiagnostico)
    {
        $this->calificacionDiagnostico = $calificacionDiagnostico;
    }

    /**
     * Get calificacionDiagnostico
     *
     * @return integer
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
     * Set hoja
     *
     * @param Itsur\AeiBundle\Entity\HojaRespuestas $hoja
     */
    public function setHoja(HojaRespuestas $hoja)
    {
        $this->hoja = $hoja;
    }

    /**
     * Get hoja
     *
     * @return Itsur\AeiBundle\Entity\HojaRespuestas 
     */
    public function getHoja()
    {
        return $this->hoja;
    }

    /**
     * Add secciones
     *
     * @param Itsur\AeiBundle\Entity\SeccionEvaluable $secciones
     */
    public function addSeccionEvaluable(SeccionEvaluable $secciones)
    {
        $this->secciones[] = $secciones;
    }

    /**
     * Get temas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTemas()
    {
        return $this->temas;
    }
    
    
    /**
     * Set area
     *
     * @param Itsur\AeiBundle\Entity\Area $area
     */
    public function setArea(\Itsur\AeiBundle\Entity\Area $area)
    {
        $this->area = $area;
    }

    /**
     * Get area
     *
     * @return Itsur\AeiBundle\Entity\Area 
     */
    public function getArea()
    {
        return $this->area;
    }
    

    /**
     * Get secciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSecciones()
    {
        return $this->secciones;
    }
    
    public function crearSecciones(\Itsur\AeiBundle\Entity\AreaPeriodo $areaPeriodo){
        $posicion = 1;

        foreach($areaPeriodo->getSecciones() as $seccion =>$seccionPeriodo){

          $se = new SeccionEvaluable();
          $se->setOrden($posicion);
          $se->setArea($this);
          $se->setSeccion($seccionPeriodo->getSeccion());
          $se->setCalificacion(0);
          $se->setPuntaje(0);
          $se->setContestada(false);
          $posicion++;

          $this->addSeccionEvaluable($se);
          $se->crearTemas($seccionPeriodo);
      }

    }

      /**
     * Get a calification
     *
     * @return a integer
     */
    public function evaluar() {
       $puntaje=0;
       $puntajeDiagnostico =0;
       $puntajeSeleccion =0;
       
       foreach($this->secciones as $seccion){

           $seccion->evaluar();
           
           $puntaje = $puntaje + $seccion->getPuntaje();
           
           if($seccion->getSeccion()->getIntension() == Seccion::SELECCIONAR ){
               $puntajeSeleccion = $puntajeSeleccion  + $seccion->getPuntaje();
           }
           
           if($seccion->getSeccion()->getIntension() == Seccion::DIAGNOSTICAR ){
               $puntajeDiagnostico = $puntajeDiagnostico  +$seccion->getPuntaje();
           }
       }
       
       if($this->area->getPuntaje() > 0){
           $this->calificacion= round(($puntaje * 100) / $this->area->getPuntaje(),2);
       }
       if($this->area->getPuntajeDiagnostico() > 0 ){
         $this->calificacionDiagnostico = round(($puntajeDiagnostico * 100) / $this->area->getPuntajeDiagnostico(),2);
       }
       if($this->area->getPuntajeSeleccion() > 0){
           $this->calificacionSeleccion = round(($puntajeSeleccion * 100) / $this->area->getPuntajeSeleccion(),2);
       }

       $this->puntaje=$puntaje;
	   $this->puntajeSeleccion=$puntajeSeleccion;
	   $this->puntajeDiagnostico=$puntajeDiagnostico;
	   
       return $this->puntaje;
    }
}