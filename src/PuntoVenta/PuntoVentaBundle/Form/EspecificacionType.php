<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EspecificacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $attrForCategoria = array('class'=>'PuntoVentaBundle:Categoria', 'property' => 'nombre',
                            'attr'=>array('class' => 'fit-parent-width' ));

        $builder
            ->add('categoria', 'entity', $attrForCategoria)
            ->add('especificacion')            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PuntoVenta\PuntoVentaBundle\Entity\Especificacion'
        ));
    }

    public function getName()
    {
        return 'puntoventa_puntoventabundle_especificaciontype';
    }
}
