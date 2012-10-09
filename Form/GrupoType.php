<?php
namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Itsur\AeiBundle\Entity\GrupoEvaluable;

class GrupoType extends AbstractType
{
    protected $grupoPreguntas;
    
    /**
     * Set grupoPreguntas
     *
     * @param Itsur\AeiBundle\Entity\GrupoEvaluable $grupo
     */
    public function setGrupoPreguntas(GrupoEvaluable $grupo)
    {
        $this->grupoPreguntas = $grupo;
    }

    /**
     * Get grupoPreguntas
     *
     * @return Itsur\AeiBundle\Entity\GrupoEvaluable
     */
    public function getGrupoPreguntas()
    {
        return $this->grupoPreguntas;
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        foreach($this->getGrupoPreguntas()->getPreguntas() as $pregunta =>$valor){
            $builder->add("".$valor->getId(),'choice',
            array(
                'choices'=>array(
                     1 => $valor->getPregunta()->getOpcion1(),
                     2 => $valor->getPregunta()->getOpcion2(),
                     3 => $valor->getPregunta()->getOpcion3(),
                     4 => $valor->getPregunta()->getOpcion4(),
                ),
                'label'=>$valor->getOrden().'. '.$valor->getPregunta()->getSentencia(),
                'required'=>false,
                'expanded'=>true,
                'multiple'=>false,
            ));

        }

    }

    /*
    $valor->getPregunta()->getOpcion1() => $valor->getPregunta()->getOpcion1(),
                     $valor->getPregunta()->getOpcion2() => $valor->getPregunta()->getOpcion2(),
                     $valor->getPregunta()->getOpcion3() => $valor->getPregunta()->getOpcion3(),
                     $valor->getPregunta()->getOpcion4() => $valor->getPregunta()->getOpcion4(),
    */
    public function getName()
    {
        return 'GrupoPreguntas';
    }

}

?>
