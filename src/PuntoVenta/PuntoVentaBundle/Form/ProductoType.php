<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $attrForPrecioUnitario = array('attr'=>array(
                'oninvalid'=>
                "setCustomValidity('Ingrese precio unitario.')",
                "onchange"=>"setCustomValidity('')"), 
            "label"=>'Precio Unitario');
            


        $attrForDescripcion = array('attr'=>array(
                'oninvalid'=>
                "setCustomValidity('Ingrese descripcion.')",
                "onchange"=>"setCustomValidity('')"));

        $attrForPuntoReorden = array('attr'=>array(
                'oninvalid'=>
                "setCustomValidity('Ingrese cantidad minima.')",
                "onchange"=>"setCustomValidity('')"), 
            'label' => "Punto de Reorden");

        $attrForUnidadMedida = array('label'=>'Unidad de medida', 'required'=>false);
        

        $attrForDisponibles = array('attr'=>array(
                'oninvalid'=>
                "setCustomValidity('Ingrese cantidad disponibles.')",
                "onchange"=>"setCustomValidity('')"));


        $attrForCategoria = array('class'=>'PuntoVentaBundle:Categoria', 'property' => 'nombre',
                            'attr'=>array('class' => 'fit-parent-width' ));
        

        $builder
            ->add('categoria', 'entity', $attrForCategoria)
            ->add('descripcion', 'text', $attrForDescripcion)
            ->add('precioUnitario', 'number', $attrForPrecioUnitario)
            ->add('disponibles', 'number', $attrForDisponibles)
            ->add('puntoReorden', 'number', $attrForPuntoReorden)
            ->add('unidadMedida', 'text', $attrForUnidadMedida)
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PuntoVenta\PuntoVentaBundle\Entity\Producto'
        ));
    }

    public function getName()
    {
        return 'puntoventa_puntoventabundle_productotype';
    }
}
