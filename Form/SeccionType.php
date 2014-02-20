<?php

namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SeccionType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('puntaje')
            ->add('intension')
            ->add('area')
        ;
    }

    public function getName()
    {
        return 'itsur_aeibundle_secciontype';
    }
}
