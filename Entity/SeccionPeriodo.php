<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\TemaPeriodo;
use Itsur\AeiBundle\Entity\AreaPeriodo;
use Itsur\AeiBundle\Entity\Seccion;

/**
 * Itsur\AeiBundle\Entity\SeccionPeriodo
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class SeccionPeriodo
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
     * @ORM\ManyToOne(targetEntity="AreaPeriodo",inversedBy="secciones")
     * @ORM\JoinColumn(name="areaPeriodo_id", referencedColumnName="id")
     */
    protected $area;

    /**
     *
     * @ORM\OneToMany(targetEntity="TemaPeriodo", mappedBy="seccion", cascade={"persist", "merge"})
     */
    protected $temas;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Seccion")
     * @ORM\JoinColumn(name="seccion_id", referencedColumnName="id")
     */
    protected $seccion;
    
    
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
     * Constructor inicializa la colecciòn de temas.
     */
    public function __construct()
    {
        $this->temas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set area
     *
     * @param Itsur\AeiBundle\Entity\AreaPeriodo $area
     */
    public function setArea(AreaPeriodo $area)
    {
        $this->area = $area;
    }

    /**
     * Get area
     *
     * @return Itsur\AeiBundle\Entity\AreaPeriodo
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Add temas
     *
     * @param Itsur\AeiBundle\Entity\TemaPeriodo $temas
     */
    public function addTemaPeriodo(TemaPeriodo $temas)
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

    /**
     * Set seccion
     *
     * @param Itsur\AeiBundle\Entity\Seccion $seccion
     */
    public function setNivel(\Itsur\AeiBundle\Entity\Seccion $seccion)
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
     * Set seccion
     *
     * @param Itsur\AeiBundle\Entity\Seccion $seccion
     */
    public function setSeccion(\Itsur\AeiBundle\Entity\Seccion $seccion)
    {
        $this->seccion = $seccion;
    }
    
    /**
     *Crea los TemaPeriodo de la sección
     *
     */
    public function crearTemas(){

        //$posiciones = Utilerias::ordenAleatorio($this->getSeccion()->getTemas()->count());
        //$posicion = 0;
        foreach($this->getSeccion()->getTemas() as $tema =>$valor){

          $te = new TemaPeriodo();
          $te->setSeccion($this);
          $te->setTema($valor);
          //$posicion++;
          
          $this->addTemaPeriodo($te);
          $te->crearGrupos();
        }

    }
    
   
}