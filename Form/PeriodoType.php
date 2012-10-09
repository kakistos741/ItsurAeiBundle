<?php
namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PeriodoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('semestre','text');
        $builder->add('anio','integer');
    }

    public function getName()
    {
        return 'periodo';
    }
    
}

?>