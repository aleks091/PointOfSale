<?php

namespace PuntoVenta\PuntoVentaBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;

use PuntoVenta\PuntoVentaBundle\Entity\VentaUnitaria;

use PuntoVenta\PuntoVentaBundle\Entity\Categoria;
use PuntoVenta\PuntoVentaBundle\Entity\Producto;

use PuntoVenta\PuntoVentaBundle\Entity\CategoriaRepository;
use PuntoVenta\PuntoVentaBundle\Entity\ProductoRepository;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\DataEvents;
use Symfony\Component\Form\Event\DataEvent;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class VentaUnitariaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$factory = $builder->getFormFactory();
    	

        $attrForProducto = array('class' => 'PuntoVentaBundle:Producto', 
            'property' => 'descripcion', 
    		'query_builder' => function (ProductoRepository $repository)
                     {
                         return $repository->getProductosOfFirstCategory();
                     });
        
        $attrForProductoId = array('attr' => array('class' => 'numeric-small-width'));
        $attrForCantidad = array('attr' => array('class' => 'numeric-small-width', 
        		'value' => '1'));
        $attrForImporte = array('attr' => array('class' => 'numeric-small-width'));  
              
        $attrForCategoria = array('class' => 'PuntoVentaBundle:Categoria', 
            'property' => 'nombre' ,
            'query_builder' => function (CategoriaRepository $repository)
                     {
                         return $repository->getCategoriasByNombre();
                     });   
        
        $attrForPrecioUnitario = array('mapped' => false, 
            'attr' => array('class' => 'numeric-small-width'));

        $builder
            ->add('cantidadProducto', 'number', $attrForCantidad)
            ->add('importe', 'number', $attrForImporte)
            ->add('productoId', 'number', $attrForProductoId)
            ->add('precioUnitario', 'number', $attrForPrecioUnitario) 
            ->add('producto', 'entity', $attrForProducto)           
            ->add('categorias', 'entity', $attrForCategoria)
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
