<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class CategoriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $attrForNombre = array('attr'=>array(
                'oninvalid'=>
                "setCustomValidity('Ingrese nombre.')",
                "onchange"=>"setCustomValidity('')"));

        $builder->add('nombre', 'text', $attrForNombre);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PuntoVenta\PuntoVentaBundle\Entity\Categoria'
        ));
    }

    public function getName()
    {
        return 'puntoventa_puntoventabundle_categoriatype';
    }
}
