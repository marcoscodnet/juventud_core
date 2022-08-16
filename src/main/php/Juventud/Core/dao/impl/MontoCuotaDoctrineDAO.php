<?php
namespace Juventud\Core\dao\impl;

use Juventud\Core\dao\IMontoCuotaDAO;

use Juventud\Core\model\MontoCuota;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para MontoCuota
 *  
 * @author Marcos
 * 
 */
class MontoCuotaDoctrineDAO extends CrudDAO implements IMontoCuotaDAO{
	
	protected function getClazz(){
		return get_class( new MontoCuota() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('mc'))
	   				->from( $this->getClazz(), "mc")
	   				->leftJoin('mc.year', 'y');
					
		
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(mc.oid)')
	   				->from( $this->getClazz(), "mc")
	   				->leftJoin('mc.year', 'y');
					
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$year = $criteria->getYear();
		if( !empty($year) && $year!=null){
			if (is_object($year)) {
				$yearOid = $year->getOid();
				if(!empty($yearOid)){
					$queryBuilder->andWhere("upper(y.oid)  = :yearOid");
					$queryBuilder->setParameter( "yearOid" , "$yearOid" );
				}
			}
			else {
				$queryBuilder->andWhere("upper(y.nombre)  like :year");
				$queryBuilder->setParameter( "year" , "%$year%" );
			}
		}
		
		
		$nro = $criteria->getNro();
		if( !empty($nro) ){
			$queryBuilder->andWhere( "mc.nro like '$nro%'");
		}
		
		$monto = $criteria->getMonto();
		if( !empty($monto) ){
			$queryBuilder->andWhere( "mc.monto like '$monto%'");
		}
		
		$vencimientoDesde = $criteria->getVencimientoDesde();
		if( !empty($vencimientoDesde) ){
			$queryBuilder->andWhere("upper(mc.vencimiento)  >= :vencimientoDesde");
			$desde = $vencimientoDesde->format("Y-m-d");
			$queryBuilder->setParameter( "vencimientoDesde" , "$desde" );
		}
	
		$vencimientoHasta = $criteria->getVencimientoHasta();
		if( !empty($vencimientoHasta) ){
			$queryBuilder->andWhere("upper(mc.vencimiento)  <= :vencimientoHasta");
			$hasta = $vencimientoHasta->format("Y-m-d");
			$queryBuilder->setParameter( "vencimientoHasta" , "$hasta" );
		}
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "mc.$name";	
		}	
		
	}	
}