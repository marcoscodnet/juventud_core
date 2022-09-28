<?php

namespace Juventud\Core\model;

use Cose\model\impl\Entity;


    
use Cose\utils\Logger;

/**
 * Docente
 * 
 * @Entity @Table(name="socios_socio")
 * 
 * @author Marcos
 */

class Socio extends Entity{

	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $apellido;
	
	
	
	/**
	 * @Column(type="integer", unique=true)
	 */
	private $dni;
	
	
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $direccion;
	
	
	
	/**
	 * @Column(type="string", length=50, nullable=true)
	 * @var string
	 */
	private $telefono;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $email;
	
	/**
     * @ManyToOne(targetEntity="Juventud\Core\model\TipoSocio",cascade={"detach"})
     * @JoinColumn(name="tipoSocio_oid", referencedColumnName="oid")
     * 
     * tipo del socio
     **/
    private $tipoSocio;
	
	/**
	 * @Column(type="date")
	 * @var \Date
	 */
	private $pagaDesde;

    /**
     * @Column(type="integer", unique=true)
     */
    private $nroSocio;

    /**
     * @return mixed
     */
    public function getNroSocio()
    {
        return $this->nroSocio;
    }

    /**
     * @param mixed $nroSocio
     */
    public function setNroSocio($nroSocio): void
    {
        $this->nroSocio = $nroSocio;
    }
		
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getApellido().', '.$this->getNombre();
	}


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

	public function getDireccion()
	{
	    return $this->direccion;
	}

	public function setDireccion($direccion)
	{
	    $this->direccion = $direccion;
	}

	public function getTelefono()
	{
	    return $this->telefono;
	}

	public function setTelefono($telefono)
	{
	    $this->telefono = $telefono;
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

	public function getPagaDesde()
	{
	    return $this->pagaDesde;
	}

	public function setPagaDesde($pagaDesde)
	{
	    $this->pagaDesde = $pagaDesde;
	}
}
?>