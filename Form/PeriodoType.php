<?php
namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PeriodoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        /*$builder->add('semestre','option');*/
		$builder->add('semestre','choice',
            array(
                'choices'=>array(
                     'Enero-Junio'=>'Enero-Junio',
                     'Agosto-Diciembre'=>'Agosto-Diciembre'                     
                ),
                'required'=>true,
                'expanded'=>false,
                'multiple'=>false,
        ));
        
		
		$builder->add('anio','choice',
		     array('choices'=>array(
			        '2013'=>'2013',
					 '2014'=>'2014',
					 '2015'=>'2015',
					 '2016'=>'2016',
					 '2017'=>'2017'),
					'required'=>true,
                    'expanded'=>false,
                    'multiple'=>false,
		));
    }

    public function getName()
    {
        return 'periodos';
    }
    
}

?>