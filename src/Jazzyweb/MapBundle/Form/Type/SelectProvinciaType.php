<?php

namespace Jazzyweb\MapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;

class SelectProvinciaType extends AbstractType
{
    public function __construct($provincias){
        $this->provincias = $provincias;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('provincia', 'choice', array(
                'choices' => $this->provincias
            ))
        ;
    }

    public function getName()
    {
        return 'select_provincias';
    }
}