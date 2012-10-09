<?php
namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AspiranteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('ficha','integer');
        $builder->add('nombre');
        $builder->add('carrera','choice',
            array(
                'choices'=>array(
                     'ING.AMBIENTAL'=>'INGENIERÍA AMBIENTAL',
                     'ING.ELECTRONICA'=>'INGENIERÍA ELECTRÓNICA',
                     'ING.INFORMATICA'=>'INGENIERÍA INFORMÁTICA',
                     'ING.INDUSTRIAL'=>'INGENIERÍA INDUSTRIAL',
                     'ING.GESTION'=>'INGENIERÍA EN GESTIÓN EMPRESARIAL',
                     'ING. SISTEMAS'=>'INGENIERÍA EN SISTEMAS COMPUTACIONALES',
                ),
                'required'=>true,
                'expanded'=>false,
                'multiple'=>false,
        ));
        $builder->add('lugarOrigen',null,
        array(
                'label'=>'Lugar de Origen'
        ));
        $builder->add('escuelaProcedencia',null,
        array(
                'label'=>'Escuela de Procedencia '
        ));
        $builder->add('bachillerato');
        $builder->add('genero','choice',
            array(
                'choices'=>array(
                     'M'=>'Masculino',
                     'F'=>'femenino',
                ),
                'label'=>'Género',
                'required'=>true,
                'expanded'=>true,
                'multiple'=>false,
        ));
        $builder->add('fechaNacimiento','birthday', array(
            'format' => 'dd-MM-yyyy',
            'label'=>'Fecha de Nacimiento '
        ));
        $builder->add('promedioBachillerato','integer',
        array(
                'label'=>'Promedio de Bachillerato '
        ));
        
    }

    public function getName()
    {
        return 'aspirante';
    }
}

?>