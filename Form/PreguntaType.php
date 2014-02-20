<?php

namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PreguntaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('sentencia')
            ->add('objetivo')
            ->add('imagen')
            ->add('respuestaImagenes')
            ->add('opcion1')
            ->add('opcion2')
            ->add('opcion3')
            ->add('opcion4')
            ->add('respuesta')
            ->add('grupo')
        ;
    }

    public function getName()
    {
        return 'itsur_aeibundle_preguntatype';
    }
}
