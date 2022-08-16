<?php
namespace Juventud\Core\dao\impl;

use Juventud\Core\dao\IYearDAO;

use Juventud\Core\model\Year;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Year
 *  
 * @author Marcos
 * 
 */
class YearDoctrineDAO extends CrudDAO implements IYearDAO{
	
	protected function getClazz(){
		return get_class( new Year() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('y'))
	   				->from( $this->getClazz(), "y");
					
		
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(y.oid)')
	   				->from( $this->getClazz(), "y");
					
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
	
				
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "y.nombre like '$nombre%'");
		}
		
		$cuotas = $criteria->getCuotas();
		if( !empty($cuotas) ){
			$queryBuilder->andWhere( "y.cuotas like '$cuotas%'");
		}
		
		$monto = $criteria->getMonto();
		if( !empty($monto) ){
			$queryBuilder->andWhere( "y.monto like '$monto%'");
		}
		
		$nombre = $criteria->getNombreMayorIgual();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "y.nombre >= '$nombre'");
		}
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "y.$name";	
		}	
		
	}	
}