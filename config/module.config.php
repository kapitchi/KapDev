<?php
return array(
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        
        'template_path_stack' => array(
            'dev' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'dev' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/dev',
                    'defaults' => array(
                        '__NAMESPACE__' => 'KapDev\Controller',
                    ),
                ),
                'may_terminate' => false,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
