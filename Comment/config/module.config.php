<?php
return array(
    'router' => array(
        'routes' => array(
             'comment_controller' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/comment[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'comment_controller',
                        'action' => 'index',
                    ),
                ), 
            ),
        ),

    ),
    'view_manager' => array(
        'template_map' => array(
            'comment_comment_index' => __DIR__ . '/../view/comment/comment/index.phtml',
        ),
        
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
