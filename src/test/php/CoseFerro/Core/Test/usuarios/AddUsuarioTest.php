<?php

namespace CoseEjemplo\Core\Test\usuarios;

use Cose\Security\model\User;

use CoseEjemplo\Core\service\ServiceFactory;

use CoseEjemplo\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

include_once dirname(__DIR__). '/conf/init.php';

class AddUsuarioTest extends GenericTest{
	
	
	public function test(){

		//para cuando tengamos los permisos configurados.
		//$securityContext =  SecurityContext::getInstance();
		//$securityContext->login( "bernardo", "bernardo");
		
		
		$this->log("agregando Usuario");		
		
		$user = new User();
		$user->setUsername("admin");
		$user->setPassword("admin");
		$user->setName("Administrador");
		$user->setEmail("admin@email.com");
		
		//le asignamos un rol.
		$serviceRol = \Cose\Security\service\ServiceFactory::getUserGroupService();
		$rol1 = $serviceRol->get(1);
		$user->setGroups( array($rol1) );
		
		$service = \Cose\Security\service\ServiceFactory::getUserService();
		$service->add( $user );
		
	}
}
?>