<?php
namespace Juventud\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de MontoCuota
 *  
 * @author Marcos
 *
 */
class MontoCuotaCriteria extends Criteria{

	private $year;
	
	private $nro;
	
	private $monto;

	private $vencimiento;
	
	private $vencimientoDesde;
	
	private $vencimientoHasta;
	

	

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

	public function getMonto()
	{
	    return $this->monto;
	}

	public function setMonto($monto)
	{
	    $this->monto = $monto;
	}

	public function getVencimiento()
	{
	    return $this->vencimiento;
	}

	public function setVencimiento($vencimiento)
	{
	    $this->vencimiento = $vencimiento;
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
}