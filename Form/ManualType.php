<?php

namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ManualType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('clave')
            ->add('nombre')
            ->add('puntaje')
            ->add('puntajeSeleccion')
            ->add('puntajeDiagnostico')
        ;
    }

    public function getName()
    {
        return 'itsur_aeibundle_manualtype';
    }
}
