<?php

namespace Juventud\Core\model;

use Cose\model\impl\Entity;


use Cose\utils\Logger;

/**
 * CuotaSocio
 * 
 * @Entity @Table(name="socios_cuota_socio",uniqueConstraints={@UniqueConstraint(name="cuota_socio_unique_idx", columns={"montoCuota_oid", "socio_oid"})})
 * 
 * @author Marcos
 */

class CuotaSocio extends Entity{

	//variables de instancia.

		
	/**
     * @ManyToOne(targetEntity="Juventud\Core\model\Socio",cascade={"detach"})
     * @JoinColumn(name="socio_oid", referencedColumnName="oid")
     * 
     * socio
     **/
    private $socio;
    
   
	
	/**
     * @ManyToOne(targetEntity="Juventud\Core\model\MontoCuota",cascade={"detach"})
     * @JoinColumn(name="montoCuota_oid", referencedColumnName="oid")
     * 
     * year de la cuota
     **/
	private $montoCuota;

	/**
	 * @Column(type="float", nullable=true)
	 * @var string
	 */
	private $monto;
    
	
    
    /**
	 * @Column(type="date", nullable=true))
	 * @var \Date
	 */
	private $vencimiento;
	
	/**
	 * @Column(type="date", nullable=true))
	 * @var \Date
	 */
	private $fechaPago;
	
		/** @Column(type="boolean") **/
	private $pagada;
	
		
	public function __construct(){
		 $this->setPagada(0);
	}
	
	public function __toString(){
		 return $this->getMontoCuota()->getYear()->getNombre().' Nro.: '.$this->getMontoCuota()->getNro();
	}



	

	

	

	public function getMonto()
	{
	    return $this->monto;
	}

	public function setMonto($monto)
	{
	    $this->monto = $monto;
	}

	

    public function getSocio()
    {
        return $this->socio;
    }

    public function setSocio($socio)
    {
        $this->socio = $socio;
    }

    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;
    }

    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;
    }

    public function getPagada()
    {
        return $this->pagada;
    }

    public function setPagada($pagada)
    {
        $this->pagada = $pagada;
    }

	public function getMontoCuota()
	{
	    return $this->montoCuota;
	}

	public function setMontoCuota($montoCuota)
	{
	    $this->montoCuota = $montoCuota;
	}
}
?>