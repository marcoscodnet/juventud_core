<?php
namespace Juventud\Core\service\impl;


use Juventud\Core\dao\DAOFactory;

use Juventud\Core\service\IYearService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Juventud\Core\model\MontoCuota;
use Juventud\Core\model\CuotaSocio;

use Juventud\Core\service\ServiceFactory;

use Cose\Security\model\User;

use Juventud\Core\conf\JuventudConfig;

use Juventud\Core\criteria\TipoSocioCriteria;
use Juventud\Core\criteria\CuotaSocioCriteria;
use Juventud\Core\criteria\SocioCriteria;

/**
 * servicio para Year
 *  
 * @author Marcos
 * @since 15-02-2017
 *
 */
class YearServiceImpl extends CrudService implements IYearService {

	
	protected function getDAO(){
		return DAOFactory::getYearDAO();
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
		for ($i = 1; $i <= $entity->getCuotas(); $i++) {
				
				$montoCuota = new MontoCuota();
				$montoCuota->setYear($entity);
				$montoCuota->setNro($i);
				$montoCuota->setMonto($entity->getMonto());
				$vencimientoStr = $entity->getNombre().'-'.$i.'-'.JuventudConfig::DIA_VENCIMIENTO;
				$vencimiento = new \Datetime($vencimientoStr);
				$montoCuota->setVencimiento($vencimiento);
				ServiceFactory::getMontoCuotaService()->add( $montoCuota );
				$tipoSocioCriteria = new TipoSocioCriteria();
				$tipoSocioCriteria->setPagaCuota(2);	
				$tipoSocios = ServiceFactory::getTipoSocioService()->getList($tipoSocioCriteria);
				if (!empty($tipoSocios)) {
					foreach ($tipoSocios as $tipoSocio) {
						$socioCriteria = new SocioCriteria();
						$socioCriteria->setTipoSocio($tipoSocio);	
						$socios = ServiceFactory::getSocioService()->getList($socioCriteria);
						if (!empty($socios)) {
							foreach ($socios as $socio) {
								$cuotaSocio = new CuotaSocio();
								$cuotaSocio->setMonto($entity->getMonto());
								$cuotaSocio->setMontoCuota($montoCuota);
								$cuotaSocio->setSocio($socio);
								$cuotaSocio->setVencimiento($vencimiento);
								ServiceFactory::getCuotaSocioService()->add( $cuotaSocio );
							}
						}
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