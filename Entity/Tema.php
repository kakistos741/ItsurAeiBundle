<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\Grupo;
use Itsur\AeiBundle\Entity\Seccion;

/**
 * Itsur\AeiBundle\Entity\Tema
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tema
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
     * @var integer $puntuacion
     *
     * @ORM\Column(name="puntuaje", type="integer", nullable="true")
     */
    protected $puntaje;
    

    /**
     * @var integer $numeroGrupos
     *
     * @ORM\Column(name="numeroGrupos", type="integer", nullable="false")
     */
    protected $numeroGrupos;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Seccion",inversedBy="temas")
     * @ORM\JoinColumn(name="seccion_id", referencedColumnName="id")
     */
    protected $seccion;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Grupo", mappedBy="tema")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    protected $grupos;

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
     * Set numeroGrupos
     *
     * @param integer $numeroGrupos
     */
    public function setNumeroGrupos($numeroGrupos)
    {
        $this->numeroGrupos = $numeroGrupos;
    }

    /**
     * Get numeroGrupos
     *
     * @return integer
     */
    public function getNumeroGrupos()
    {
        return $this->numeroGrupos;
    }
    


    /**
     * Set seccion
     *
     * @param Itsur\AeiBundle\Entity\Seccion $seccion
     */
    public function setSeccion(Seccion $seccion)
    {
        $this->seccion = $seccion;
    }

    /**
     * Get seccion
     *
     * @return Itsur\AeiBundle\Entity\Seccion
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Add grupos
     *
     * @param Itsur\AeiBundle\Entity\Grupo $grupos
     */
    public function addGrupo(Grupo $grupos)
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
}