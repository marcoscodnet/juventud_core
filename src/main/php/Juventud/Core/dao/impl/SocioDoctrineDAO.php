<?php
namespace Juventud\Core\dao\impl;

use Juventud\Core\dao\ISocioDAO;

use Juventud\Core\model\Socio;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Socio
 *  
 * @author Marcos
 * 
 */
class SocioDoctrineDAO extends CrudDAO implements ISocioDAO{
	
	protected function getClazz(){
		return get_class( new Socio() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('s'))
	   				->from( $this->getClazz(), "s")
	   				->leftJoin('s.tipoSocio', 'ts');
					
		
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(s.oid)')
	   				->from( $this->getClazz(), "s")
	   				->leftJoin('s.tipoSocio', 'ts');
					
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$tipoSocio = $criteria->getTipoSocio();
		if( !empty($tipoSocio) && $tipoSocio!=null){
			if (is_object($tipoSocio)) {
				$tipoSocioOid = $tipoSocio->getOid();
				if(!empty($tipoSocioOid)){
					$queryBuilder->andWhere("upper(ts.oid)  = :tipoSocioOid");
					$queryBuilder->setParameter( "tipoSocioOid" , "$tipoSocioOid" );
				}
			}
			else {
				$queryBuilder->andWhere("upper(ts.tipo)  like :tipoSocio");
				$queryBuilder->setParameter( "tipoSocio" , "%$tipoSocio%" );
			}
		}
		
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "s.nombre like '$nombre%'");
		}
		
		$apellido = $criteria->getApellido();
		if( !empty($apellido) ){
			$queryBuilder->andWhere( "s.apellido like '$apellido%'");
		}
		
		$dni = $criteria->getDni();
		if( !empty($dni) ){
			$queryBuilder->andWhere( "s.dni like '$dni%'");
		}
		
		$email = $criteria->getEmail();
		if( !empty($email) ){
			$queryBuilder->andWhere( "s.email like '$email%'");
		}
		
		
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "s.$name";	
		}	
		
	}	
}