<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VentaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $attrForVentasUnitarias = array('type' => new VentaUnitariaType(),             
            'allow_add' => true, 
            'allow_delete' => true,
            'by_reference' => false);

        $builder
            ->add('fechaRealizada')
            ->add('clienteId')
            ->add('ventasUnitarias', 'collection', $attrForVentasUnitarias)
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
