<?php
namespace PuntoVenta\PuntoVentaBundle\Resources\viewModels;

class ProductoViewModel{

	 public function getProductoSelector(FormBuilderInterface $builder, array $options)
    {

        $attrForCategoria= array('class' => 'PuntoVentaBundle:Producto', 'property' => 'descripcion');

        $builder->add('producto', 'entity', $attrForCategoria);

        return $builder;
    }
}