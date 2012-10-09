<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\Area;

/**
 * Itsur\AeiBundle\Entity\Manual
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Manual
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
     * @var string $clave
     *
     * @ORM\Column(name="clave", type="string", length=10)
     */
    protected $clave;

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
     * @var integer $puntajeSeleccion
     *
     * @ORM\Column(name="puntuajeSeleccion", type="integer", nullable="true")
     */
    protected $puntajeSeleccion;
    
    /**
     * @var integer $puntajeDiagnostico
     *
     * @ORM\Column(name="puntajeDiagnostico", type="decimal", nullable="true")
     */
    protected $puntajeDiagnostico;
    
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Area", mappedBy="manual")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    protected $areas;
    
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
     * Set clave
     *
     * @param string $clave
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    /**
     * Get clave
     *
     * @return string 
     */
    public function getClave()
    {
        return $this->clave;
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
     * Add areas
     *
     * @param Itsur\AeiBundle\Entity\Area $areas
     */
    public function addArea(Area $areas)
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
}