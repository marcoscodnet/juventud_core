<?php
namespace Juventud\Core\dao\impl;

use Juventud\Core\dao\ITipoSocioDAO;

use Juventud\Core\model\TipoSocio;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para TipoSocio
 *  
 * @author Marcos
 * 
 */
class TipoSocioDoctrineDAO extends CrudDAO implements ITipoSocioDAO{
	
	protected function getClazz(){
		return get_class( new TipoSocio() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('ts'))
	   				->from( $this->getClazz(), "ts");
					
		
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(ts.oid)')
	   				->from( $this->getClazz(), "ts");
					
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
	
				
		$tipo = $criteria->getTipo();
		if( !empty($tipo) ){
			$queryBuilder->andWhere( "ts.tipo like '$tipo%'");
		}
		
		$pagaCuota = $criteria->getPagaCuota();
		if( !empty($pagaCuota) ){
			if ($pagaCuota == 2) {
				$queryBuilder->andWhere("upper(ts.pagaCuota)  = 1");
			}
			else 
				$queryBuilder->andWhere("upper(ts.pagaCuota)  = 0");
		}
		
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "ts.$name";	
		}	
		
	}	
}