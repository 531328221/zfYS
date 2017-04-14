<?php

/*return array(
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
		'layout'              => 'layout/admin_layout',
	),
	'service_manager' => array(
		'invokables' => array(
			'User\Service\PostServiceInterface' => 'User\Service\PostService',
		),
	),
	'controllers' => array(
		'factories' => array(
			'User\Controller\Front' => 'User\Factory\FrontControllerFactory',
		),
	),
	'router' => array(
		'routes' => array(
			'user' => array(
				'type'   => 'literal',
				'options'=> array(
					'route'   => '/user',
					'defaults'=> array(
						'controller' => 'User\Controller\Front',
						'action'     => 'index',
					),
				),
			),
		),
	),
);*/

use User\Controller;
use User\Service;
use User\View;
use Psr\Log;

return [
    'router' => [
        'routes' => [
            'user' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/user',
                    'defaults' => [
                        'controller' => User\Controller\FrontController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'login' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route' => '/login',
                        ],
                    ],
                    'userInfo' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route' => '/userInfo',
                        ],
                    ],
                    'default' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route' => '[/:action]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                ],
                'priority' => 1,
                
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            User\Controller\FrontController::class => User\Factory\FrontControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'invokables' => [
			'User\Service\PostServiceInterface' => 'User\Service\PostService',
		],
    ],
    'view_manager' => [
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/error'                      => __DIR__ . '/../view/layout/layout.phtml',
            'layout/layout'                     => __DIR__ . '/../view/layout/layout.phtml',
            'layout/user_center_layout'         => __DIR__ . '/../../Layout/view/user/user_center_layout.phtml',
            'error/404'                         => __DIR__ . '/../view/error/404.phtml',
            'error/index'                       => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            'User' => __DIR__ . '/../view',
        ],

        'strategies' => [
            'ViewFeedStrategy',
        ],
    ],

    'view_helpers' => [
        'invokables' => [
            'FlashMessenger' => View\Helper\FlashMessenger::class,
        ],
        'factories' => [
            'gitHubRepositoryUrl' => View\Helper\GitHubRepositoryUrlFactory::class,
            'sanitizeHtml' => View\Helper\SanitizeHtmlFactory::class,
        ],
    ],
];
