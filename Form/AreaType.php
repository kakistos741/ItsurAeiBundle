<?php

namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AreaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('puntaje')
            ->add('puntajeDiagnostico')
            ->add('puntajeSeleccion')
            ->add('tiempo')
            ->add('manual')
        ;
    }

    public function getName()
    {
        return 'itsur_aeibundle_areatype';
    }
}
