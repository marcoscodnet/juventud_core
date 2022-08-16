<?php

namespace Juventud\Core\model;

use Cose\model\impl\Entity;

use Cose\Security\model\User;

use Cose\utils\Logger;

/**
 * MontoCuota
 * 
 * @Entity @Table(name="socios_monto_cuota",uniqueConstraints={@UniqueConstraint(name="cuota_unique_idx", columns={"year_oid", "nro"})})
 * 
 * 
 * @author Marcos
 */

class MontoCuota extends Entity{

	//variables de instancia.

		
	/**
	 * @Column(type="integer")
	 * @var string
	 */
	private $nro;

	/**
	 * @Column(type="float")
	 * @var string
	 */
	private $monto;
    
	/**
     * @ManyToOne(targetEntity="Juventud\Core\model\Year",cascade={"persist","remove"})
     * @JoinColumn(name="year_oid", referencedColumnName="oid", onDelete="CASCADE")
     * 
     * year de la cuota
     **/
    private $year;
	
    /**
	 * @Column(type="date", nullable=true))
	 * @var \Date
	 */
	private $vencimiento;
		
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getYear()->getNombre().' '.$this->getNro();
	}



	public function getYearNro(){
		 return $this->getYear()->getNombre().' '.$this->getNro();
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

	public function getYear()
	{
	    return $this->year;
	}

	public function setYear($year)
	{
	    $this->year = $year;
	}

	public function getVencimiento()
	{
	    return $this->vencimiento;
	}

	public function setVencimiento($vencimiento)
	{
	    $this->vencimiento = $vencimiento;
	}
}
?>