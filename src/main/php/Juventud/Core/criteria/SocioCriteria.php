<?php
namespace Juventud\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Socio
 *  
 * @author Marcos
 *
 */
class SocioCriteria extends Criteria{

	
	private $nombre;
	
	private $apellido;
	
	private $dni;
	
	private $email;
	
    private $tipoSocio;

	


	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getApellido()
	{
	    return $this->apellido;
	}

	public function setApellido($apellido)
	{
	    $this->apellido = $apellido;
	}

	public function getDni()
	{
	    return $this->dni;
	}

	public function setDni($dni)
	{
	    $this->dni = $dni;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	}

	public function getTipoSocio()
	{
	    return $this->tipoSocio;
	}

	public function setTipoSocio($tipoSocio)
	{
	    $this->tipoSocio = $tipoSocio;
	}
}