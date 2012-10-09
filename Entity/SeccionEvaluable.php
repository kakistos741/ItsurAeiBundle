<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\iEvaluable;
use Itsur\AeiBundle\Entity\TemaEvaluable;
use Itsur\AeiBundle\Entity\AreaEvaluable;
use Itsur\AeiBundle\Entity\Seccion;

/**
 * Itsur\AeiBundle\Entity\NivelEvaluable
 *
 * @ORM\Table()
* @ORM\Entity(repositoryClass="Itsur\AeiBundle\Repository\SeccionEvaluableRepository")
 */
class SeccionEvaluable  implements iEvaluable
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
     * @var integer $puntuacion
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
     * @ORM\ManyToOne(targetEntity="AreaEvaluable",inversedBy="secciones")
     * @ORM\JoinColumn(name="areaEvaluable_id", referencedColumnName="id")
     */
    protected $area;

    /**
     *
     * @ORM\OneToMany(targetEntity="TemaEvaluable", mappedBy="seccion", cascade={"persist", "merge"})
     * @ORM\OrderBy({"orden" = "ASC"})
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
    

    public function __construct()
    {
        $this->temas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set area
     *
     * @param Itsur\AeiBundle\Entity\AreaEvaluable $area
     */
    public function setArea(AreaEvaluable $area)
    {
        $this->area = $area;
    }

    /**
     * Get area
     *
     * @return Itsur\AeiBundle\Entity\AreaEvaluable
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Add temas
     *
     * @param Itsur\AeiBundle\Entity\TemaEvaluable $temas
     */
    public function addTemaEvaluable(TemaEvaluable $temas)
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
     *Crea los TemasEvalubles de la sección
     *
     */
    public function crearTemas(){
        $posiciones = Utilerias::ordenAleatorio($this->getSeccion()->getTemas()->count());
        $posicion = 0;
        foreach($this->getSeccion()->getTemas() as $tema =>$valor){

          $te = new TemaEvaluable();
          $te->setOrden($posiciones[$posicion]);
          $te->setSeccion($this);
          $te->setTema($valor);
          $te->setPuntaje(0);
          $te->setCalificacion(0);
          $te->setContestada(false);
          $posicion++;
          
          $this->addTemaEvaluable($te);
          $te->crearGrupos();
        }

    }
    
    /**
     * Get a calification
     *
     * @return a integer
     */
    public function evaluar() {
        $this->puntaje = 0;

       foreach($this->temas as $tema){
           $tema->evaluar();
           $this->puntaje = $this->puntaje + $tema->getPuntaje();
       }

       $this->calificacion = round(($this->puntaje * 100)/ $this->seccion->getPuntaje(),2);

       return $this->puntaje;
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
}