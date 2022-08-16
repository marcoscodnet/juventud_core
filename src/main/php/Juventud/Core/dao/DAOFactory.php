<?php
namespace Juventud\Core\dao;

/**
 * Factory de DAOs
 *  
 * @author Marcos
 *
 */
use Juventud\Core\dao\impl\YearDoctrineDAO;
use Juventud\Core\dao\impl\MontoCuotaDoctrineDAO;
use Juventud\Core\dao\impl\TipoSocioDoctrineDAO;
use Juventud\Core\dao\impl\SocioDoctrineDAO;
use Juventud\Core\dao\impl\CuotaSocioDoctrineDAO;

class DAOFactory {

	
	/**
	 * DAO para Year.
	 * 
	 * @return IYear
	 */
	public static function getYearDAO(){
	
		return new YearDoctrineDAO();	
	}
	
	/**
	 * DAO para MontoCuota.
	 * 
	 * @return IMontoCuota
	 */
	public static function getMontoCuotaDAO(){
	
		return new MontoCuotaDoctrineDAO();	
	}
	
	/**
	 * DAO para TipoSocio.
	 * 
	 * @return ITipoSocio
	 */
	public static function getTipoSocioDAO(){
	
		return new TipoSocioDoctrineDAO();	
	}
	
	/**
	 * DAO para Socio.
	 * 
	 * @return ISocio
	 */
	public static function getSocioDAO(){
	
		return new SocioDoctrineDAO();	
	}
	
	/**
	 * DAO para CuotaSocio.
	 * 
	 * @return ICuotaSocio
	 */
	public static function getCuotaSocioDAO(){
	
		return new CuotaSocioDoctrineDAO();	
	}
	
}
