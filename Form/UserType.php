<?php
namespace Itsur\AeiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('username', null,
           array(
                'label'=>'Usuario '
        ));
        $builder->add('password', "password",
           array(
                'label'=>'Contraseña ',
                'required'=>true,
                'always_empty'=>true,
                'max_length'=>40,
        ));
        $builder->add('isActive', null,
        array(
                'label'=>'Activo ',
        ));
    }

    public function getName()
    {
        return 'user';
    }
}

?>