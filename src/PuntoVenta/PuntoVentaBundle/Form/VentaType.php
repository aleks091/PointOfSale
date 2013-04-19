<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use PuntoVenta\PuntoVentaBundle\Entity\Cliente;
use PuntoVenta\PuntoVentaBundle\Entity\ClienteRepository;
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

        $attrForCliente = array('class' => 'PuntoVentaBundle:Cliente',
            'property' => 'nombre',
            'query_builder' => function(ClienteRepository $repository){
                return $repository->getDefaultCliente();
            });

        $builder
            ->add('fechaRealizada')
            ->add('cliente', 'entity', $attrForCliente)
            ->add('ventasUnitarias', 'collection', $attrForVentasUnitarias)
            ->add('fechaPagada')
            ->add('total', null, array('attr' => array('class' => 'numeric-medium-width')))
            ->add('subtotal', null, array('attr' => array('class' => 'numeric-medium-width')))
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
