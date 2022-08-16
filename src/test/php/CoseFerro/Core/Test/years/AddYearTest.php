<?php

namespace Juventud\Core\Test\years;

use Juventud\Core\model\Year;

use Juventud\Core\service\ServiceFactory;

use Juventud\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

include_once dirname(__DIR__). '/conf/init.php';

class AddYearTest extends GenericTest{
	
	
	public function test(){

		//para cuando tengamos los permisos configurados.
		//$securityContext =  SecurityContext::getInstance();
		//$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getYearService();
		
		$this->log("agregando Año");		
		
		$year = new Year();
		$year->setNombre("2016");
		$year->setCuotas(10);
		$year->setMonto( "25.6" );
		$service->add( $year );
		
		
	}
}
?>