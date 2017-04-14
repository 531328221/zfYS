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
        $app = $e->getParam('application');
        $app->getEventManager()->attach('dispatch', array($this, 'setMobileLayout'));
    }

    public function setMobileLayout($e)
    {

        $matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        if (false === strpos($controller, __NAMESPACE__)) {
            // not a controller from this module
            return;
        }

        // Set the layout template
        $viewModel = $e->getViewModel();
     /*   if($e->getRequest()->isXmlHttpRequest()) {//这里暂不确定在mobile中是否有用处
            $viewModel->setTerminal(true);
        } else {*/
            $viewModel->setTemplate('layout/user_center_layout');
     /*   }*/
    }
}