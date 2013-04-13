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
    	
    	$attrForProducto = array('class' => 'PuntoVentaBundle:Producto', 
    							 'property' => 'descripcion',
    							 'query_builder' => function(ProductoRepository $repository){
    									return $repository->getProductosOfFirstCategory();
    							 });
    	
    	$attrForCategoria = array('class' => 'PuntoVentaBundle:Categoria', 
    							 'property' => 'nombre',
    							 'query_builder' => function(CategoriaRepository $repository){
    									return $repository->getCategoriasByNombre();
    							 });
    	
        $builder
        	->add('productoId', 'text')
        	->add('categoria', 'entity', $attrForCategoria)
        	->add('producto', 'entity', $attrForProducto)            
            ->add('precioUnitario', 'text', array('mapped' => false, 'attr' => array('value' => $options['attr']['precioUnitario'])))
            ->add('cantidadProducto', 'number', array('attr'=>array('value' => $options['attr']['cantidadProducto'])))
            ->add('importe')
            ->add('productoId')            
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
