<?php
namespace Juventud\Core\dao\impl;

use Juventud\Core\dao\ICuotaSocioDAO;

use Juventud\Core\model\CuotaSocio;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para CuotaSocio
 *  
 * @author Marcos
 * 
 */
class CuotaSocioDoctrineDAO extends CrudDAO implements ICuotaSocioDAO{
	
	protected function getClazz(){
		return get_class( new CuotaSocio() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('cs'))
	   				->from( $this->getClazz(), "cs")
	   				->leftJoin('cs.socio', 's')
	   				->leftJoin('cs.montoCuota', 'mc')
	   				->leftJoin('mc.year', 'y');
					
		
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(cs.oid)')
	   				->from( $this->getClazz(), "cs")
	   				->leftJoin('cs.socio', 's')
	   				->leftJoin('cs.montoCuota', 'mc')
	   				->leftJoin('mc.year', 'y');
					
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		
		
		$socio = $criteria->getSocio();
		if( !empty($socio) && $socio!=null){
			if (is_object($socio)) {
				$socioOid = $socio->getOid();
				if(!empty($socioOid)){
					$queryBuilder->andWhere("upper(s.oid)  = :socioOid");
					$queryBuilder->setParameter( "socioOid" , "$socioOid" );
				}
			}
			else {
				$queryBuilder->andWhere("upper(s.apellido)  like :socio");
				$queryBuilder->setParameter( "socio" , "%$socio%" );
			}
		}
		
		$fechaPagoDesde = $criteria->getFechaPagoDesde();
		if( !empty($fechaPagoDesde) ){
			$queryBuilder->andWhere("upper(cs.fechaPago)  >= :fechaPagoDesde");
			$desde = $fechaPagoDesde->format("Y-m-d");
			$queryBuilder->setParameter( "fechaPagoDesde" , "$desde" );
		}
	
		$fechaPagoHasta = $criteria->getFechaPagoHasta();
		if( !empty($fechaPagoHasta) ){
			$queryBuilder->andWhere("upper(cs.fechaPago)  <= :fechaPagoHasta");
			$hasta = $fechaPagoHasta->format("Y-m-d");
			$queryBuilder->setParameter( "fechaPagoHasta" , "$hasta" );
		}
		
		$vencimientoDesde = $criteria->getVencimientoDesde();
		if( !empty($vencimientoDesde) ){
			$queryBuilder->andWhere("upper(cs.vencimiento)  >= :vencimientoDesde");
			$desde = $vencimientoDesde->format("Y-m-d");
			$queryBuilder->setParameter( "vencimientoDesde" , "$desde" );
		}
	
		$vencimientoHasta = $criteria->getVencimientoHasta();
		if( !empty($vencimientoHasta) ){
			$queryBuilder->andWhere("upper(cs.vencimiento)  <= :vencimientoHasta");
			$hasta = $vencimientoHasta->format("Y-m-d");
			$queryBuilder->setParameter( "vencimientoHasta" , "$hasta" );
		}
		
		$montoCuota = $criteria->getMontoCuota();
		if( !empty($montoCuota) && $montoCuota!=null){
			if (is_object($montoCuota)) {
				$montoCuotaOid = $montoCuota->getOid();
				if(!empty($montoCuotaOid)){
					$queryBuilder->andWhere("upper(mc.oid)  = :montoCuotaOid");
					$queryBuilder->setParameter( "montoCuotaOid" , "$montoCuotaOid" );
				}
			}
			else {
				$queryBuilder->andWhere("upper(mc.nro)  like :montoCuota");
				$queryBuilder->setParameter( "montoCuota" , "%$montoCuota%" );
			}
		}
		
		$pagada = $criteria->getPagada();
		if( !empty($pagada) ){
			if ($pagada == 2) {
				$queryBuilder->andWhere("upper(cs.pagada)  = 1");
			}
			else 
				$queryBuilder->andWhere("upper(cs.pagada)  = 0");
		}
		
		$nro = $criteria->getNro();
		if( !empty($nro) ){
			$queryBuilder->andWhere("upper(mc.nro)  = :nro");
			$queryBuilder->setParameter( "nro" , "$nro" );
		}
		
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
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "cs.$name";	
		}	
		
	}	
}