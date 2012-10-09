<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Itsur\AeiBundle\Entity\HojaRespuestas;

/**
 * Itsur\AeiBundle\Entity\Aspirante
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Itsur\AeiBundle\Repository\AspiranteRepository")
 */
class Aspirante
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
     * @var integer $ficha
     *
     * @ORM\Column(name="ficha", type="integer")
     * @Assert\NotNull(message = "El numero de ficha es obligatorio.")
     */
    protected $ficha;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\MaxLength(255)
     * @Assert\NotNull(message = "El nombre es obligatorio.")
     */
    protected $nombre;

    /**
     * @var string $carrera
     *
     * @ORM\Column(name="carrera", type="string", length=255)
     * @Assert\MaxLength(255)
     * @Assert\NotNull(message = "La carrera es obligatoria.")
     */
    protected $carrera;

    /**
     * @var string $lugarOrigen
     *
     * @ORM\Column(name="lugarOrigen", type="string", length=255)
     * @Assert\MaxLength(255)
     * @Assert\NotNull(message = "El lugar de origen es obligatorio.")
     */
    protected $lugarOrigen;

    /**
     * @var string $escuelaProcedencia
     *
     * @ORM\Column(name="escuelaProcedencia", type="string", length=255)
     * @Assert\MaxLength(255)
     * @Assert\NotNull(message = "La escuela de procedencia es obligatoria.")
     */
    protected $escuelaProcedencia;

    /**
     * @var string $bachillerato
     *
     * @ORM\Column(name="bachillerato", type="string", length=255)
     * @Assert\MaxLength(255)
     * @Assert\NotNull(message = "El bachillerato es obligatorio.")
     */
    protected $bachillerato;

    /**
     * @var string $genero
     *
     * @ORM\Column(name="genero", type="string", length=10)
     * @Assert\MaxLength(10)
     * @Assert\NotNull(message = "El genero es obligatorio.")
     */
    protected $genero;

    /**
     * @var date $fechaNacimiento
     *
     * @ORM\Column(name="fechaNacimiento", type="date")
     * @Assert\NotBlank(message = "La fecha de nacimiento es obligatoria.")
     */
    protected $fechaNacimiento;

    /**
     * @var smallint $promedioBachillerato
     *
     * @ORM\Column(name="promedioBachillerato", type="smallint")
     * @Assert\Min(limit= "0", message = "Debe ser un valor entre 0 y 10.")
     * @Assert\Max(limit= "10", message = "Debe ser un valor entre 0 y 10.")
     * @Assert\NotNull(message = "El promedio del bachillerato es obligatorio.")
     */
    protected $promedioBachillerato;
    
    
    /**
     *
     * @ORM\OneToOne(targetEntity="HojaRespuestas", mappedBy="aspirante")
     */
    protected $hoja;
    

    /**
     *
     * @ORM\ManyToOne(targetEntity="Periodo",inversedBy="aspirantes")
     * @ORM\JoinColumn(name="periodo_id", referencedColumnName="id")
     */
    protected $periodo;
    

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
     * Set ficha
     *
     * @param integer $ficha
     */
    public function setFicha($ficha)
    {
        $this->ficha = $ficha;
    }

    /**
     * Get ficha
     *
     * @return integer 
     */
    public function getFicha()
    {
        return $this->ficha;
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
     * Set carrera
     *
     * @param string $carrera
     */
    public function setCarrera($carrera)
    {
        $this->carrera = $carrera;
    }

    /**
     * Get carrera
     *
     * @return string 
     */
    public function getCarrera()
    {
        return $this->carrera;
    }

    /**
     * Set lugarOrigen
     *
     * @param string $lugarOrigen
     */
    public function setLugarOrigen($lugarOrigen)
    {
        $this->lugarOrigen = $lugarOrigen;
    }

    /**
     * Get lugarOrigen
     *
     * @return string 
     */
    public function getLugarOrigen()
    {
        return $this->lugarOrigen;
    }

    /**
     * Set escuelaProcedencia
     *
     * @param string $escuelaProcedencia
     */
    public function setEscuelaProcedencia($escuelaProcedencia)
    {
        $this->escuelaProcedencia = $escuelaProcedencia;
    }

    /**
     * Get escuelaProcedencia
     *
     * @return string 
     */
    public function getEscuelaProcedencia()
    {
        return $this->escuelaProcedencia;
    }

    /**
     * Set bachillerato
     *
     * @param string $bachillerato
     */
    public function setBachillerato($bachillerato)
    {
        $this->bachillerato = $bachillerato;
    }

    /**
     * Get bachillerato
     *
     * @return string 
     */
    public function getBachillerato()
    {
        return $this->bachillerato;
    }

    /**
     * Set genero
     *
     * @param string $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * Get genero
     *
     * @return string 
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set fechaNacimiento
     *
     * @param date $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * Get fechaNacimiento
     *
     * @return date 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set promedioBachillerato
     *
     * @param smallint $promedioBachillerato
     */
    public function setPromedioBachillerato($promedioBachillerato)
    {
        $this->promedioBachillerato = $promedioBachillerato;
    }

    /**
     * Get promedioBachillerato
     *
     * @return smallint 
     */
    public function getPromedioBachillerato()
    {
        return $this->promedioBachillerato;
    }

    /**
     * Set hoja
     *
     * @param Itsur\AeiBundle\Entity\HojaRespuestas $hoja
     */
    public function setHoja(HojaRespuestas $hoja)
    {
        $this->hoja = $hoja;
    }

    /**
     * Get hoja
     *
     * @return Itsur\AeiBundle\Entity\HojaRespuestas 
     */
    public function getHoja()
    {
        return $this->hoja;
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
}