<?php

namespace PuntoVenta\PuntoVentaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * IVARepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IVARepository extends EntityRepository
{
	public function findAllOrderByFechaAgregado(){
		$repository = $this->getEntityManager();
	
		$query = $repository->createQueryBuilder()
							->select('i')
							->from('PuntoVentaBundle:IVA', 'i')
							->orderBy('i.fechaAgregado', 'DESC')
							->getQuery();
	
		return $query->getResult();
	}

    public function findLatestQuery(){
        $repository = $this->getEntityManager();

        return $repository->createQueryBuilder()
            ->select('i')
            ->from('PuntoVentaBundle:IVA', 'i')
            ->orderBy('i.fechaAgregado', 'DESC')
            ->setMaxResults(1);
    }

	public function findLatest(){

		$query = $this->findLatestQuery()
							->getQuery();
	
		try{
			return $query->getSingleResult();
		}catch(\Doctrine\Orm\NoResultException $e){
			return null;
		}
	}
}
