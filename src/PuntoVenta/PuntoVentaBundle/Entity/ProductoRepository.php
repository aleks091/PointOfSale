<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * ProductoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductoRepository extends EntityRepository
{
	public function getProductosOfFirstCategory(){
			
		$repository = $this->getEntityManager();
		
		$firstCategoria = $repository->createQueryBuilder()
							->select('c.id')
							->from('PuntoVentaBundle:Categoria', 'c')
							->orderBy('c.nombre', 'ASC')
							->setMaxResults(1)
							->getQuery()
							->getSingleScalarResult();

		
		return $repository->createQueryBuilder()
							->select('p')
							->from('PuntoVentaBundle:Producto', 'p')
							->innerJoin('p.categoria', 'c')
							->orderBy('p.descripcion', 'ASC')
							->where('c.id = :categoryId')
							->setParameter('categoryId', $firstCategoria);					
	
	}


	
	public function getFirstProductoOfFirstCategory(){

        $producto = $this->getProductosOfFirstCategory()
                            ->setMaxResults(1)
                            ->getQuery()
                            ->getSingleResult();

        return ($producto == null) ? new Producto() : $producto;
	}
}
