<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\Tema;
use Itsur\AeiBundle\Entity\Area;

/**
 * Itsur\AeiBundle\Entity\Seccion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Seccion
{
    const SELECCIONAR ='SELECCIONAR';
    const DIAGNOSTICAR ='DIAGNOSTICAR';
    
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
     * @var integer $puntuacion
     *
     * @ORM\Column(name="puntuaje", type="integer", nullable="true")
     */
    protected $puntaje;
    
    /**
     * @var string $intension
     *
     * @ORM\Column(name="intension", type="string", length=12)
     */
    protected $intension;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Area",inversedBy="secciones")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    protected $area;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Tema", mappedBy="seccion")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    protected $temas;
    
    
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
     * Set intesion
     *
     * @param string $intesion
     */
    public function setIntension($intesion)
    {
        $this->intesion = $intesion;
    }

    /**
     * Get intesion
     *
     * @return string
     */
    public function getIntension()
    {
        return $this->intension;
    }
    
    /**
     * Set area
     *
     * @param Itsur\AeiBundle\Entity\Area $area
     */
    public function setArea(Area $area)
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
    
    public function __construct()
    {
        $this->temas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add temas
     *
     * @param Itsur\AeiBundle\Entity\Tema $temas
     */
    public function addTema(Tema $temas)
    {
        $this->temas[] = $temas;
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
    
    public function crearTemas(){

    }
}