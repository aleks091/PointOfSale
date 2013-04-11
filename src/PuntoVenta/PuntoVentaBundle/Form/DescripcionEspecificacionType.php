<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DescripcionEspecificacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion')            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PuntoVenta\PuntoVentaBundle\Entity\DescripcionEspecificacion'
        ));
    }

    public function getName()
    {
        return 'puntoventa_puntoventabundle_descripcionespecificaciontype';
    }
}
