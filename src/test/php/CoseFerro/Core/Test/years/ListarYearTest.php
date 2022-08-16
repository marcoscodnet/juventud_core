<?php

namespace Juventud\Core\Test\years;


use Juventud\Core\criteria\YearCriteria;

use Juventud\Core\service\ServiceFactory;

include_once dirname(__DIR__). '/conf/init.php';

use Juventud\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

class ListYearsTest extends GenericTest{
	
	public function test(){

		//para cuando incorporamos los permisos:
		//$securityContext =  SecurityContext::getInstance();
		//$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getYearService();
		
		$this->log("listando años", __CLASS__);
		
		$criteria = new YearCriteria();
		
		$entities = $service->getList( $criteria );
		
		foreach ($entities as $entity) {
			
			$this->log("Año: " . $entity, __CLASS__);
			
		}
		
	}
}
?>