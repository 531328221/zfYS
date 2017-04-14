<?php

namespace YSfront;

use YSfront\Helper\Helper as frontHelper;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class Module
{
	/*public function getConfig() {echo 12323;
		return include __DIR__ . '/config/module.config.php';
	}*/

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
               array(
               	'YSfront\Helper\Helper' => __DIR__ . '/src/Helper/Helper.php'
           	   )
            ),
		);
	}
	public function getServiceConfig() {
		return array(
			'factories' => array(
				'frontHelper' => function() { return new \YSfront\Helper\Helper();
				},
				'frontCache'  => function() { return \Zend\Cache\StorageFactory::factory(
					array(
						'adapter' => array(
							'name'    => 'filesystem',
							'options' => array(
								'dirLevel' => 0,
								'cacheDir' => 'data/cache/frontcache',
								'dirPermission' => 0755,
								'filePermission' => 0666,
								'ttl' => (defined('FRONT_CACHE_EXPIRE_TIME') ? FRONT_CACHE_EXPIRE_TIME : 600),
								'namespaceSeparator' => '-ys-'
							)
						)
					)
				);}
			),
		);
		
	}
}