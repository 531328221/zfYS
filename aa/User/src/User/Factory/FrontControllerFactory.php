<?php

namespace User\Factory;

use User\Controller\FrontController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfModule\Mapper;

class FrontControllerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator) {


		$realServiceLocator = $serviceLocator->getServiceLocator();
		//$postService = $realServiceLocator->get(Mapper\Module::class);echo 123123;exit;
		$postService        = $realServiceLocator->get('User\Service\PostServiceInterface'); 

		return new FrontController($postService);
	}
}