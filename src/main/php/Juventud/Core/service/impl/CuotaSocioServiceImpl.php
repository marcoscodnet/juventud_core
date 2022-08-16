<?php
namespace Juventud\Core\service\impl;


use Juventud\Core\dao\DAOFactory;

use Juventud\Core\service\ICuotaSocioService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Cose\Security\model\User;

/**
 * servicio para CuotaSocio
 *  
 * @author Marcos
 * @since 21-02-2017
 *
 */
class CuotaSocioServiceImpl extends CrudService implements ICuotaSocioService {

	
	protected function getDAO(){
		return DAOFactory::getCuotaSocioDAO();
	}
	
	
	/**
	 * redefino el add para agregar funcionalidad
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){

		/*
		 * Hacemos lo que queremos con la year. 
		 * Por ejemplo, enviar un email al usuario.
		 */
		
		//agregamos la year.
		parent::add($entity);
		
	}	
	
	function validateOnAdd( $entity ){
	
		/*
		 * Realizamos validaciones sobre la year. 
		 * Por ejemplo, campos obligatorios.
		 */		
	}
		
	
	function validateOnUpdate( $entity ){
	
		/*
		 * Validaciones como en el add pero 
		 * las necesarias para modificar.
		 */
		
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){
	
		/*
		 * validaciones al borrar una year.
		 */
	}

	
	
	
}	