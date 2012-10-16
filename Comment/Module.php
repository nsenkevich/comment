<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Comment;

use Zend\Mvc\ModuleRouteListener;

class Module {

    public function onBootstrap($e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

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

    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'commentList' => function ($serviceManager) {
                    $locator = $serviceManager->getServiceLocator();
                    $viewHelper = new View\Helper\CommentList();
                    $viewHelper->setCommentService($locator->get('comment_service'));
                    return $viewHelper;
                },
                'commentAdd' => function ($serviceManager) {
                    $locator = $serviceManager->getServiceLocator();
                    $viewHelper = new View\Helper\CommentAdd();
                    $viewHelper->setCommentForm($locator->get('comment_form'));
                    return $viewHelper;
                },
            ),
        );

    }
    
    public function getServiceConfig() {
        return array(
            'invokables' => array(
                'Comment\Form\CommentForm'  => 'Comment\Form\CommentForm',
                //'comment_service'           => 'Comment\Service\Comment',
            ),
            'factories' => array(
                'comment_service' => function ($sm) {
                    //$locator = $sm->getServiceLocator();
                    $comment_service = new Service\Comment();
                    //$comment_service->setFilemanagerService($sm->get('filemanager_service'));
                    //$comment_service->setRepository($sm->get('comment_repository'));
                    $form = $sm->get('comment_form');
                    $comment_service->setCommentForm($form);
                    return $comment_service;
                },
                'comment_form' => function($serviceManager) {
                    $form = new Form\CommentForm();
                    $comment = new Entity\Comment();
                    $form->setInputFilter($comment->getInputFilter());
                    return $form;
                },
                
            ),
        );
    }
    
    public function getControllerConfig()
    {
        return array(
            'factories' => array(
            'comment_controller' => function ($sm) {
                $controller = new \Comment\Controller\CommentController();
                $locator = $sm->getServiceLocator();
                $form = $locator->get('comment_form');
                $controller->setCommentForm($form);
                $service = $locator->get('comment_service');
                $controller->setCommentService($service);
                return $controller;
            }
        ));
    }

}
