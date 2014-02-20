<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\AreaPeriodo;
use Itsur\AeiBundle\Entity\Aspirante;
use Itsur\AeiBundle\Entity\Manual;

/**
 * Itsur\AeiBundle\Entity\ManualPeriodo
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ManualPeriodo
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
     * @var datetime $fechaCreacion
     *
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    protected $fechaCreacion;



    /**
     *
     * @ORM\ManyToOne(targetEntity="Periodo")
     * @ORM\JoinColumn(name="periodo_id", referencedColumnName="id")
     */
    protected $periodo;
    

     /**
     *
     * @ORM\ManyToOne(targetEntity="Manual")
     * @ORM\JoinColumn(name="manual_id", referencedColumnName="id")
     */
    protected $manual;



    /**
     *
     * @ORM\OneToMany(targetEntity="AreaPeriodo", mappedBy="manual", cascade={"persist", "merge"})
     */
    protected $areas;


    
    /**
     *Constructor de la clase inicializa la colecciòn de areas.
     */
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
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set fechaCreacion
     *
     * @param datetime $fecha
     */
    public function setFechaCreacion($fecha)
    {
        $this->fechaCreacion = $fecha;
    }

    /**
     * Get fechaCreacion
     *
     * @return datetime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    
    /**
     * Add areas
     *
     * @param Itsur\AeiBundle\Entity\AreaPeriodo$areas
     */
    public function addAreaPeriodo(AreaPeriodo $areas)
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
     * Set maual
     *
     * @param Itsur\AeiBundle\Entity\Manual $maual
     */
    public function setManual(Manual $manual)
    {
        $this->manual = $manual;
    }

    /**
     * Get manual
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
     * Crea las areas evaluables del objeto ManualPeriodo.
     */
    public function crearAreas(){
      
      foreach($this->getManual()->getAreas() as $area =>$valor){
          $ae = new AreaPeriodo();
          $ae->setManual($this);
          $ae->setArea($valor);

          $this->addAreaPeriodo($ae);
          $ae->crearSecciones();

      }

    }
}