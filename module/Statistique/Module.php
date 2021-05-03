<?php

namespace Statistique;



use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Statistique\Model\StatistiqueTable;
use Statistique\Model\Statistique;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface, ViewHelperProviderInterface {

	public function registerJsonStrategy(MvcEvent $e)
	{
		$app          = $e->getTarget();
		$locator      = $app->getServiceManager();
		$view         = $locator->get('Zend\View\View');
		$jsonStrategy = $locator->get('ViewJsonStrategy');

		// Attach strategy, which is a listener aggregate, at high priority
		$view->getEventManager()->attach($jsonStrategy, 100);
	}

	public function getAutoloaderConfig() {
		return array (
				'Zend\Loader\StandardAutoloader' => array (
						'namespaces' => array (
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
						)
				)
		);
	}
	
	public function getConfig() {
		// var_dump('test'); exit();

		return include __DIR__ . '/config/module.config.php';

		// var_dump('test'); exit();
	}
	
	
	public function getServiceConfig() {
		return array (
				'factories' => array (
						'Statistique\Model\StatistiqueTable' => function ($sm) {
						    $tableGateway = $sm->get( 'StatistiqueTableGateway' );
						    $table = new StatistiqueTable($tableGateway);
						    return $table;
						},
						
						'StatistiqueTableGateway' => function ($sm) {
						    $dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
						    $resultSetPrototype = new ResultSet ();
						    $resultSetPrototype->setArrayObjectPrototype ( new Statistique() );
						    return new TableGateway ( 'personne', $dbAdapter, null, $resultSetPrototype );
						},
						
						
				)
		);
	}

	
	public function getViewHelperConfig() {
		return array ();
	}



}