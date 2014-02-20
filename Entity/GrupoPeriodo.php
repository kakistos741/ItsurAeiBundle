<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\TemaPeriodo;
use Itsur\AeiBundle\Entity\PreguntaPeriodo;
use Itsur\AeiBundle\Entity\Grupo;

/**
 * Itsur\AeiBundle\Entity\GrupoPeriodo
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class GrupoPeriodo
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
     * @ORM\ManyToOne(targetEntity="TemaPeriodo",inversedBy="grupos")
     * @ORM\JoinColumn(name="temaPeriodo_id", referencedColumnName="id")
     */
    protected $tema;

    /**
     *
     * @ORM\OneToMany(targetEntity="PreguntaPeriodo", mappedBy="grupo", cascade={"persist", "merge"})
     */
    protected $preguntas;
    
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Grupo")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    protected $grupo;

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
     * Constructo de la clase, inicializa la colecciòn de preguntas.
     */
     public function __construct()
    {
        $this->preguntas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set tema
     *
     * @param Itsur\AeiBundle\Entity\TemaPeriodo $tema
     */
    public function setTema(TemaPeriodo $tema)
    {
        $this->tema = $tema;
    }

    /**
     * Get tema
     *
     * @return Itsur\AeiBundle\Entity\TemaPeriodo
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Add preguntas
     *
     * @param Itsur\AeiBundle\Entity\PreguntaPeriodo $preguntas
     */
    public function addPregunta(PreguntaPeriodo $preguntas)
    {
        $this->preguntas[] = $preguntas;
    }

    /**
     * Get preguntas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }

    /**
     * Add preguntas
     *
     * @param Itsur\AeiBundle\Entity\PreguntaPeriodo $preguntas
     */
    public function addPreguntaPeriodo(\Itsur\AeiBundle\Entity\PreguntaPeriodo $preguntas)
    {
        $this->preguntas[] = $preguntas;
    }

    /**
     * Set grupo
     *
     * @param Itsur\AeiBundle\Entity\Grupo $grupo
     */
    public function setGrupo(\Itsur\AeiBundle\Entity\Grupo $grupo)
    {
        $this->grupo = $grupo;
    }


    /**
     * Get grupo
     *
     * @return Itsur\AeiBundle\Entity\Grupo 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }
    
    /**
     *Crea las PreguntaPeriodos del GrupoPeriodo
     *
     */
    public function crearPreguntas(){
        
        $cuantasPreguntas = $this->getGrupo()->getNumeroPreguntas();
        $disponibles = $this->getGrupo()->getPreguntas()->count();

        if($cuantasPreguntas == $disponibles){
            for($numero = 0; $numero<=$disponibles-1; $numero++){
                    $preg = $this->getGrupo()->getPreguntas()->get($numero);
                    $pe = new PreguntaPeriodo();
                    $pe->setGrupo($this);
                    $pe->setPregunta($preg);
                    $this->addPreguntaPeriodo($pe);
            }
        }
        else{
            $posiciones = Utilerias::selecionarAleatorio($cuantasPreguntas, $disponibles);
                
            for($numero = 0; $numero<=$disponibles-1; $numero++){
                if($posiciones[$numero] == 1){
                    $preg = $this->getGrupo()->getPreguntas()->get($numero);
                    $pe = new PreguntaPeriodo();
                    $pe->setGrupo($this);
                    $pe->setPregunta($preg);
                    $this->addPreguntaPeriodo($pe);
                }
            }

        }  
    }
}