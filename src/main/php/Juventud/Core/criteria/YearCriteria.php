<?php
namespace Juventud\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Year
 *  
 * @author Marcos
 *
 */
class YearCriteria extends Criteria{

	private $nombre;
	
	private $cuotas;
	
	private $monto;

	private $nombreMayorIgual;

	

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

    public function getNombreMayorIgual()
    {
        return $this->nombreMayorIgual;
    }

    public function setNombreMayorIgual($nombreMayorIgual)
    {
        $this->nombreMayorIgual = $nombreMayorIgual;
    }
}