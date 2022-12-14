<?php

//include_once '../conf/init.php';
include_once   dirname(__DIR__). '/vendor/autoload.php';

$classLoader = new \Doctrine\Common\ClassLoader('Entities', __DIR__);
$classLoader->register();

$classLoader = new \Doctrine\Common\ClassLoader('Proxies', __DIR__);
$classLoader->register();

$pathEntities = array( 
	dirname(__DIR__) . "/src/main/php/Juventud/Core/model" ,
	"D:/Documents/Mis Webs/codnet_services/cose_security/src/main/php" 
	);

$isDevMode = true;
$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration( $pathEntities, $isDevMode);

$connectionOptions = array(
      'driver'   => 'pdo_mysql',
				    'host'     => "localhost",
					'dbname'   => "cose_juventud",
				    'user'     => "root",
				    'password' => ""
);

$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helpers = array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
);
