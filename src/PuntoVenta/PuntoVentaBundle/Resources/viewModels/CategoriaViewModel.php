<?php 

namespace PuntoVenta\PuntoVentaBundle\Resources\viewModels;

use PuntoVenta\PuntoVentaBundle\Entity\Categoria;
use Symfony\Component\Form\FormBuilder;

class CategoriaViewModel{


	public function __construct(){
		
	}

    public function getCategoriaSelector(FormBuilder $builder)
    {

        $attrForCategoria= array('class' => 'PuntoVentaBundle:Categoria', 
                                'property' => 'nombre', 
                                'label' => ' ');

        $builder->add('categoria', 'entity', $attrForCategoria);

        return $builder;
    }


	public function getCategoriaSelection($categorias , $selectedId = 0){

		$categoriasVm = array();


		foreach($categorias as $index => $categoria){
            $isSelected = '';

            if($categoria->getId() == $selectedId)
                $isSelected = 'selected';                


            $categoriasVm[] = array('id' => $categoria->getId(), 
                                'nombre' => $categoria->getNombre(),
                                'isSelected' => $isSelected);
        }

        return $categoriasVm;
	}


}