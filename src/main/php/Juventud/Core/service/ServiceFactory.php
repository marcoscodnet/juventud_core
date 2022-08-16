<?php
namespace Juventud\Core\service;

/**
 * Factory de servicios
 *  
 *  
 * @author Marcos
 * @since 15-02-2017
 *
 */

use Juventud\Core\service\impl\YearServiceImpl;
use Juventud\Core\service\impl\MontoCuotaServiceImpl;
use Juventud\Core\service\impl\TipoSocioServiceImpl;
use Juventud\Core\service\impl\SocioServiceImpl;
use Juventud\Core\service\impl\CuotaSocioServiceImpl;

class ServiceFactory {


	/**
	 * Service para Year.
	 * 
	 * @return IYearService
	 */
	public static function getYearService(){
	
		return new YearServiceImpl();	
	}
	
	/**
	 * Service para MontoCuota.
	 * 
	 * @return IMontoCuotaService
	 */
	public static function getMontoCuotaService(){
	
		return new MontoCuotaServiceImpl();	
	}
	
	/**
	 * Service para TipoSocio.
	 * 
	 * @return ITipoSocioService
	 */
	public static function getTipoSocioService(){
	
		return new TipoSocioServiceImpl();	
	}
	
	/**
	 * Service para Socio.
	 * 
	 * @return ISocioService
	 */
	public static function getSocioService(){
	
		return new SocioServiceImpl();	
	}
	
	/**
	 * Service para CuotaSocio.
	 * 
	 * @return ICuotaSocioService
	 */
	public static function getCuotaSocioService(){
	
		return new CuotaSocioServiceImpl();	
	}
	
}