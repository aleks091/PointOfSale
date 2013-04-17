<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use PuntoVenta\PuntoVentaBundle\Entity\CategoriaRepository;

use PuntoVenta\PuntoVentaBundle\Entity\ProductoRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VentaUnitariaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    	$attrForProductos = array('class' => 'PuntoVentaBundle:Producto',
    							 'property' => 'descripcion',
    							 'query_builder' => function(ProductoRepository $repository){
    									return $repository->getProductosOfFirstCategory();
    							 });
    	
    	$attrForCategoria = array('class' => 'PuntoVentaBundle:Categoria',
                                 'mapped' => false,
    							 'property' => 'nombre',
    							 'query_builder' => function(CategoriaRepository $repository){
    									return $repository->getCategoriasByNombre();
    							 });
    	
        $builder
        	->add('productoId', 'text',  array('attr' => array( 'class' => 'numeric-small-width')))
        	->add('categoria', 'entity', $attrForCategoria)
        	->add('producto', 'entity', $attrForProductos)
            ->add('precioUnitario', 'text', array('attr' => array( 'class' => 'numeric-small-width')))
            ->add('cantidadProducto', null, array('attr' => array('class' => 'numeric-small-width')))
            ->add('importe', null, array('attr' => array('class' => 'numeric-small-width')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PuntoVenta\PuntoVentaBundle\Entity\VentaUnitaria'
        ));
    }

    public function getName()
    {
        return 'puntoventa_puntoventabundle_ventaunitariatype';
    }
}
