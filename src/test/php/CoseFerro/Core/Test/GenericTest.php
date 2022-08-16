<?php

namespace Juventud\Core\Test;

use Cose\utils\Logger;
use Juventud\Core\conf\JuventudConfig;
use Cose\persistence\PersistenceContext;

class GenericTest extends \PHPUnit_Framework_TestCase{
	
	/**
	 * 
	 * @var \Cose\persistence\PersistenceContext
	 */
	protected $persistenceContext;
	
	protected function setUp() {

		//inicializamos cuentas core.
		JuventudConfig::getInstance()->initialize();
		JuventudConfig::getInstance()->initLogger(dirname(__DIR__) . "/Test/conf/log4php.xml");
				
		$this->persistenceContext =  PersistenceContext::getInstance();
		
	}
	
	protected function tearDown() {

		$this->log("successful!", __CLASS__);
		
        //cerramos la conexión a la base.
        $this->persistenceContext->close();
    }
    
    protected function log($msg, $clazz=__CLASS__){
    	Logger::log($msg, $clazz);
    }
    
    protected function logObject($object, $clazz=__CLASS__){
    	Logger::logObject($object, $clazz);
    }
    
}
?>