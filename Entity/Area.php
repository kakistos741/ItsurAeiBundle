<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\Manual;
use Itsur\AeiBundle\Entity\Seccion;
/**
 * Itsur\AeiBundle\Entity\Area
 *
 * @ORM\Table(name="Area")
 * @ORM\Entity
 */
class Area
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    protected $nombre;
    
    /**
     * @var integer $puntaje
     *
     * @ORM\Column(name="puntuaje", type="integer", nullable="true")
     */
    protected $puntaje;
    
    /**
     * @var integer $puntajeDiagnostico
     *
     * @ORM\Column(name="puntajeDiagnostico", type="integer", nullable="true")
     */
    protected $puntajeDiagnostico;
    
    
    /**
     * @var integer $puntajeSeleccion
     *
     * @ORM\Column(name="puntajeSeleccion", type="integer", nullable="true")
     */
    protected $puntajeSeleccion;

    /**
     * @var integer $tiempo
     *
     * @ORM\Column(name="tiempo", type="integer")
     */
    protected $tiempo;

     /**
     *
     * @ORM\ManyToOne(targetEntity="Manual",inversedBy="areas")
     * @ORM\JoinColumn(name="manual_id", referencedColumnName="id")
     */
    protected $manual;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Seccion", mappedBy="area")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    protected $secciones;


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
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
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
     * Set puntajeSeleccion
     *
     * @param integer $puntajeSeleccion
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
     * Set manual
     *
     * @param Itsur\AeiBundle\Entity\Manual $manual
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
     * Add secciones
     *
     * @param Itsur\AeiBundle\Entity\Seccion $secciones
     */
    public function addSeccion(Seccion $secciones)
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
    
}