<?php

namespace CoseEjemplo\Core\Test\usuarios;

use Cose\Security\model\UserGroup;

use CoseEjemplo\Core\service\ServiceFactory;

use CoseEjemplo\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

include_once dirname(__DIR__). '/conf/init.php';

class AddRolTest extends GenericTest{
	
	
	public function test(){

		//para cuando tengamos los permisos configurados.
		//$securityContext =  SecurityContext::getInstance();
		//$securityContext->login( "bernardo", "bernardo");
		
		
		$this->log("agregando Rol");		
		
		$rol = new UserGroup();
		$rol->setName("Admin");
		$rol->setDescription("Administrador");
		$rol->setLevel(1);
		
		//le asignamos un permiso.
		$servicePermiso = \Cose\Security\service\ServiceFactory::getPermissionService();
		$perm1 = $servicePermiso->get(1);
		$rol->setPermissions( array($perm1) );
		
		$service = \Cose\Security\service\ServiceFactory::getUserGroupService();
		$service->add( $rol );
		
	}
}
?>