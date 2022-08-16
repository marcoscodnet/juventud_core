<?php
namespace Juventud\Core\service\impl;


use Juventud\Core\dao\DAOFactory;

use Juventud\Core\service\ISocioService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;

use Juventud\Core\service\ServiceFactory;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Juventud\Core\utils\JuventudUtils;

use Juventud\Core\criteria\YearCriteria;
use Juventud\Core\criteria\MontoCuotaCriteria;

use Juventud\Core\model\CuotaSocio;



/**
 * servicio para Socio
 *  
 * @author Marcos
 * @since 19-02-2017
 *
 */
class SocioServiceImpl extends CrudService implements ISocioService {

	
	protected function getDAO(){
		return DAOFactory::getSocioDAO();
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
		if ($entity->getTipoSocio()->getPagaCuota()) {
			$anio = JuventudUtils::yearOfDate($entity->getPagaDesde());
			$mes = JuventudUtils::monthOfDate($entity->getPagaDesde());
			$yearCriteria = new YearCriteria();
			$yearCriteria->setNombreMayorIgual($anio);
			
			$years = ServiceFactory::getYearService()->getList($yearCriteria);
			$primero=1;
			if (!empty($years)) {
				foreach ($years as $year) {
					$montoCuotaCriteria = new MontoCuotaCriteria();
					$montoCuotaCriteria->setYear($year);
					$montoCuotas = ServiceFactory::getMontoCuotaService()->getList($montoCuotaCriteria);
					foreach ($montoCuotas as $montoCuota) {
						if (($montoCuota->getNro()>=intval($mes))||(!$primero)) {
							$cuotaSocio = new CuotaSocio();
							$cuotaSocio->setMonto($montoCuota->getMonto());
							$cuotaSocio->setMontoCuota($montoCuota);
							$cuotaSocio->setSocio($entity);
							$cuotaSocio->setVencimiento($montoCuota->getVencimiento());
							ServiceFactory::getCuotaSocioService()->add( $cuotaSocio );
						}
					}
					$primero=0;
				}
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