<?php

namespace Juventud\Core\model;

use Cose\model\impl\Entity;


use Cose\utils\Logger;

/**
 * Cargo
 * 
 * @Entity @Table(name="socios_tipo_socio")
 * 
 * @author Marcos
 */

class TipoSocio extends Entity{

	

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $tipo;

	/** @Column(type="boolean") **/
	private $pagaCuota;
	
	
	
		
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getTipo();
	}



	

	

	public function getTipo()
	{
	    return $this->tipo;
	}

	public function setTipo($tipo)
	{
	    $this->tipo = $tipo;
	}

	public function getPagaCuota()
	{
	    return $this->pagaCuota;
	}

	public function setPagaCuota($pagaCuota)
	{
	    $this->pagaCuota = $pagaCuota;
	}
}
?>