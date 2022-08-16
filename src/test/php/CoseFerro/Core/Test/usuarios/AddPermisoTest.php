<?php

namespace CoseEjemplo\Core\Test\usuarios;

use Cose\Security\model\Permission;

use CoseEjemplo\Core\service\ServiceFactory;

use CoseEjemplo\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

include_once dirname(__DIR__). '/conf/init.php';

class AddPermisoTest extends GenericTest{
	
	
	public function test(){

		//para cuando tengamos los permisos configurados.
		//$securityContext =  SecurityContext::getInstance();
		//$securityContext->login( "bernardo", "bernardo");
		
		
		$this->log("agregando Permiso");		
		
		$permiso = new Permission();
		$permiso->setName("Modulo1");
		$permiso->setDescription("Modulo UNO");
		
		$service = \Cose\Security\service\ServiceFactory::getPermissionService();
		
		$service->add( $permiso );
		
	}
}
?>