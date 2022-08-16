<?php

namespace Juventud\Core\model;

use Cose\model\impl\Entity;

use Cose\Security\model\User;

use Cose\utils\Logger;

/**
 * Year
 * 
 * @Entity @Table(name="socios_year")
 * 
 * @author Marcos
 */

class Year extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string", unique=true)
	 * @var string
	 */
	private $nombre;
	
	/**
	 * @Column(type="integer")
	 * @var string
	 */
	private $cuotas;

	/**
	 * @Column(type="float")
	 * @var string
	 */
	private $monto;
    

	
		
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getNombre();
	}



	

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getCuotas()
	{
	    return $this->cuotas;
	}

	public function setCuotas($cuotas)
	{
	    $this->cuotas = $cuotas;
	}

	public function getMonto()
	{
	    return $this->monto;
	}

	public function setMonto($monto)
	{
	    $this->monto = $monto;
	}
}
?>