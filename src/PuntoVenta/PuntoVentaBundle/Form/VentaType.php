<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VentaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaRealizada')
            ->add('clienteId')
            ->add('fechaPagada')
            ->add('total')
            ->add('subtotal')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PuntoVenta\PuntoVentaBundle\Entity\Venta'
        ));
    }

    public function getName()
    {
        return 'puntoventa_puntoventabundle_ventatype';
    }
}
