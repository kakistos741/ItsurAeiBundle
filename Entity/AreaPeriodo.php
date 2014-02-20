<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\ManualPeriodo;
use Itsur\AeiBundle\Entity\SeccionPeriodo;
use Itsur\AeiBundle\Entity\Seccion;
use Itsur\AeiBundle\Entity\Area;

/**
 * Itsur\AeiBundle\Entity\AreaPeriodo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AreaPeriodo
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
     * @ORM\ManyToOne(targetEntity="ManualPeriodo",inversedBy="areas")
     * @ORM\JoinColumn(name="manual_id", referencedColumnName="id")
     */
    protected $manual;

    /**
     *
     * @ORM\OneToMany(targetEntity="SeccionPeriodo", mappedBy="area", cascade={"persist", "merge"})
     */
    protected $secciones;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Area")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    protected $area;
    

    /**
     *Constructor de la clase inicializa la coleccion de secciones.
     */
    public function __construct()
    {
        $this->secciones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set Manual
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

    /**
     * Add secciones
     *
     * @param Itsur\AeiBundle\Entity\SeccionPeriodo $secciones
     */
    public function addSeccionPeriodo(SeccionPeriodo $secciones)
    {
        $this->secciones[] = $secciones;
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
     *Crea las secciones del manual de periodo.
     */
    public function crearSecciones(){

        foreach($this->getArea()->getSecciones() as $seccion =>$valor){

          $se = new SeccionPeriodo();
          $se->setArea($this);
          $se->setSeccion($valor);

          $this->addSeccionPEriodo($se);
          $se->crearTemas();
      }

    }
}