<?php
namespace Juventud\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de CuotaSocio
 *  
 * @author Marcos
 *
 */
class CuotaSocioCriteria extends Criteria{

	
	private $year;
	
	private $nro;
	
	private $montoCuota;
	
	private $socio;

	private $pagada;
	
	private $vencimiento;
	
	private $vencimientoDesde;
	
	private $vencimientoHasta;
	
	private $fechaPago;
	
	private $fechaPagoDesde;
	
	private $fechaPagoHasta;

	

	

	

	

	

    public function getSocio()
    {
        return $this->socio;
    }

    public function setSocio($socio)
    {
        $this->socio = $socio;
    }

    public function getPagada()
    {
        return $this->pagada;
    }

    public function setPagada($pagada)
    {
        $this->pagada = $pagada;
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

    public function getVencimientoDesde()
    {
        return $this->vencimientoDesde;
    }

    public function setVencimientoDesde($vencimientoDesde)
    {
        $this->vencimientoDesde = $vencimientoDesde;
    }

    public function getVencimientoHasta()
    {
        return $this->vencimientoHasta;
    }

    public function setVencimientoHasta($vencimientoHasta)
    {
        $this->vencimientoHasta = $vencimientoHasta;
    }

    public function getFechaPagoDesde()
    {
        return $this->fechaPagoDesde;
    }

    public function setFechaPagoDesde($fechaPagoDesde)
    {
        $this->fechaPagoDesde = $fechaPagoDesde;
    }

    public function getFechaPagoHasta()
    {
        return $this->fechaPagoHasta;
    }

    public function setFechaPagoHasta($fechaPagoHasta)
    {
        $this->fechaPagoHasta = $fechaPagoHasta;
    }

	public function getMontoCuota()
	{
	    return $this->montoCuota;
	}

	public function setMontoCuota($montoCuota)
	{
	    $this->montoCuota = $montoCuota;
	}

	public function getYear()
	{
	    return $this->year;
	}

	public function setYear($year)
	{
	    $this->year = $year;
	}

	public function getNro()
	{
	    return $this->nro;
	}

	public function setNro($nro)
	{
	    $this->nro = $nro;
	}
}