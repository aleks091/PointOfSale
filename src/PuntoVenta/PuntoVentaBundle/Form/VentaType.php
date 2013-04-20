<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use PuntoVenta\PuntoVentaBundle\Entity\Cliente;
use PuntoVenta\PuntoVentaBundle\Entity\ClienteRepository;
use PuntoVenta\PuntoVentaBundle\Entity\IVARepository;
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

        $attrForIva = array('class' => 'PuntoVentaBundle:IVA',
        'property' => 'iva',
        'query_builder' => function(IVARepository $repository){
            return $repository->findLatestQuery();
        });

        $valueForCantidadIva = 0;

        if(isset($options['attr']['cantidadIva']))
            $valueForCantidadIva = $options['attr']['cantidadIva'];

        $optionsForCantidadIva =  array('mapped' => false, 'attr' =>
            array('class' => 'numeric-medium-width',
                  'value' => $valueForCantidadIva));

        $valueForTc = 0;

        if(isset($options['attr']['tipoCambio']))
            $valueForTc = $options['attr']['tipoCambio'];

        $attrForNumber = array('mapped' => false, 'attr' =>
        array('class' => 'numeric-medium-width',
            'value' => $valueForTc));

        $builder
            ->add('fechaRealizada')
            ->add('cliente', 'entity', $attrForCliente)
            ->add('ventasUnitarias', 'collection', $attrForVentasUnitarias)
            ->add('fechaPagada')
            ->add('cantidadIva', 'number', $optionsForCantidadIva)
            ->add('tc', 'number', $attrForNumber)
            ->add('iva','entity',$attrForIva)
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
