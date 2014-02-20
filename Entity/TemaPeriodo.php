<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\GrupoPeriodo;
use Itsur\AeiBundle\Entity\SeccionPeriodo;
use Itsur\AeiBundle\Entity\Tema;
use Itsur\AeiBundle\Entity\Utilerias;

/**
 * Itsur\AeiBundle\Entity\TemaPeriodo
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class TemaPeriodo
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
     * @ORM\ManyToOne(targetEntity="SeccionPeriodo",inversedBy="temas")
     * @ORM\JoinColumn(name="seccionPeriodo_id", referencedColumnName="id")
     */
    protected $seccion;

    /**
     *
     * @ORM\OneToMany(targetEntity="GrupoPeriodo", mappedBy="tema", cascade={"persist", "merge"})
     */
    protected $grupos;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Tema")
     * @ORM\JoinColumn(name="tema_id", referencedColumnName="id")
     */
    protected $tema;
    
    
    
    /**
     *Constructor de la clase, inicializa la coleccion de grupos.
     */
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
     * Set seccion
     *
     * @param Itsur\AeiBundle\Entity\SeccionPeriodo $seccion
     */
    public function setSeccion(SeccionPeriodo $seccion)
    {
        $this->seccion = $seccion;
    }

    /**
     * Get seccion
     *
     * @return Itsur\AeiBundle\Entity\SeccionPeriodo
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Add grupos
     *
     * @param Itsur\AeiBundle\Entity\GrupoPeriodo $grupos
     */
    public function addGrupoPeriodo(GrupoPeriodo $grupos)
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
    

    /**
     * Set tema
     *
     * @param Itsur\AeiBundle\Entity\Tema $tema
     */
    public function setTema(\Itsur\AeiBundle\Entity\Tema $tema)
    {
        $this->tema = $tema;
    }

    /**
     * Get tema
     *
     * @return Itsur\AeiBundle\Entity\Tema 
     */
    public function getTema()
    {
        return $this->tema;
    }
    
    /**
     *Crea los GrupoPeriodos del TemaPeriodo
     */
    public function crearGrupos(){
        $cuantosGrupos = $this->getTema()->getNumeroGrupos();
        $disponibles = $this->getTema()->getGrupos()->count();
        
          
        if($cuantosGrupos == $disponibles){
           for($numero = 0; $numero<=$disponibles-1; $numero++){
                $grupo = $this->getTema()->getGrupos()->get($numero);
                $ge = new GrupoPeriodo();
                $ge->setTema($this);
                $ge->setGrupo($grupo);
                $this->addGrupoPeriodo($ge);
                $ge->crearPreguntas();
            } 
        }
        else{
            
            $posiciones = Utilerias::selecionarAleatorio($cuantosGrupos, $disponibles);

            for($numero = 0; $numero<=$disponibles-1; $numero++){
                if( $posiciones[$numero] == 1 ){
                    $grupo = $this->getTema()->getGrupos()->get($numero);
                    $ge = new GrupoPeriodo();
                    $ge->setTema($this);
                    $ge->setGrupo($grupo);
                    $this->addGrupoPeriodo($ge);
                    $ge->crearPreguntas();
                }
            }  

        }      
                    
        
    }
}