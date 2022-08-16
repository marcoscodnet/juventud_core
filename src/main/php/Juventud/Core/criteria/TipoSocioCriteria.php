<?php
namespace Juventud\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de TipoSocio
 *  
 * @author Marcos
 *
 */
class TipoSocioCriteria extends Criteria{

	private $tipo;
	
	private $pagaCuota;
	
	

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