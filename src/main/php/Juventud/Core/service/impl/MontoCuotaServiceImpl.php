<?php
namespace Juventud\Core\service\impl;


use Juventud\Core\dao\DAOFactory;

use Juventud\Core\service\IMontoCuotaService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;

use Juventud\Core\service\ServiceFactory;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Cose\Security\model\User;

use Juventud\Core\criteria\CuotaSocioCriteria;

/**
 * servicio para MontoCuota
 *  
 * @author Marcos
 * @since 19-02-2017
 *
 */
class MontoCuotaServiceImpl extends CrudService implements IMontoCuotaService {

	
	protected function getDAO(){
		return DAOFactory::getMontoCuotaDAO();
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
	
	/**
	 * redefino el add para agregar funcionalidad
	 * @param $entity
	 * @throws ServiceException
	 */
	public function update($entity){

		/*
		 * Hacemos lo que queremos con la year. 
		 * Por ejemplo, enviar un email al usuario.
		 */
		
		//agregamos la year.
		parent::update($entity);
		$cuotaSocioCriteria = new CuotaSocioCriteria();
		$cuotaSocioCriteria->setMontoCuota($entity);
		$cuotaSocioCriteria->setPagada(1);	
		$cuotaSocios = ServiceFactory::getCuotaSocioService()->getList($cuotaSocioCriteria);
		
		if (!empty($cuotaSocios)) {
			foreach ($cuotaSocios as $cuotaSocio) {
				$cuotaSocio->setVencimiento($entity->getVencimiento());
				$cuotaSocio->setMonto($entity->getMonto());
				ServiceFactory::getCuotaSocioService()->update( $cuotaSocio );
			}	
		}
		
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