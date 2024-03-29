<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TipoCambioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TipoCambioRepository extends EntityRepository
{
	public function findAllOrderByFechaAgregado(){
		$repository = $this->getEntityManager();
	
		$query = $repository->createQueryBuilder()
							->select('i')
							->from('PuntoVentaBundle:TipoCambio', 'i')
							->orderBy('i.fechaAgregado', 'DESC')
							->getQuery();
	
		return $query->getResult();
	}

	public function findLatest(){
		$repository = $this->getEntityManager();
	
		$query = $repository->createQueryBuilder()
							->select('i')
							->from('PuntoVentaBundle:TipoCambio', 'i')
							->orderBy('i.fechaAgregado', 'DESC')
							->setMaxResults(1)
							->getQuery();
	
		try{
			return $query->getSingleResult();
		}catch(\Doctrine\Orm\NoResultException $e){
			return null;
		}
	}
}
