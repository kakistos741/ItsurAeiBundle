<?php
namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Itsur\AeiBundle\Entity\Periodo;
use Itsur\AeiBundle\Entity\Manual;

class ConfiguracionType extends AbstractType
{
    private $periodoActual;
    private $manualActual;
    private $periodos;
    private $manuales;

    public function getPeriodoActual(){
        return $this->periodoActual;
    }

    public function setPeriodoActual($periodoActual){
      $this->periodoActual = $periodoActual;
    }

    public function getManualActual(){
        return $this->manualActual;
    }

    public function setManualActual($manualActual){
      $this->manualActual = $manualActual;
    }

    public function getPeriodos(){
        return $this->periodos;
    }

    public function setPeriodos($periodos){
      $this->periodos = $periodos;
    }

    public function getManuales(){
        return $this->manuales;
    }

    public function setManuales($manuales){
      $this->manuales = $manuales;
    }


    public function buildForm(FormBuilder $builder, array $options)
    {
		//Lista de periodos disponibles
        $periodosDisponibles = array();
        foreach($this->getPeriodos() as $periodo =>$valor){
            $periodosDisponibles[''.$valor->getId()] =   ' ' .$valor->getAnio()  . ' ' . $valor->getSemestre();
        }

        //Lista de manuales disponibles
        $manualesDisponibles = array();
        foreach($this->getManuales() as $manual =>$valor){
            $manualesDisponibles[''.$valor->getClave()] =  $valor->getClave() . ' ' . $valor->getNombre();
        }

        $builder->add('periodo','choice',
            array(
                'choices'=> $periodosDisponibles,
                'label'=>'Periodo Actual',
                'required'=>true,
                'expanded'=>false,
                'multiple'=>false,
            )
        );

        $builder->add('manual','choice',
            array(
                'choices'=> $manualesDisponibles,
                'label'=>'Manual Actual',
                'required'=>true,
                'expanded'=>false,
                'multiple'=>false,
            )
        );
    }

    public function getName()
    {
        return 'configuracion';
    }
    
}

?>