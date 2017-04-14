<?php

namespace User;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements 
	ConfigProviderInterface,
	AutoloaderProviderInterface
{
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function onBootstrap($e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // Attach logger for exceptions
        $eventManager->attach('dispatch.error', function (MvcEvent $event) {
            $exception = $event->getResult()->exception;
            if ($exception) {
                $sm      = $event->getApplication()->getServiceManager();
                $service = $sm->get(Service\ErrorHandlingService::class);
                $service->logException($exception);
            }
        });
    }
}