<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Comment\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Comment\Service\Comment as CommentService;
use Comment\Form\CommentForm;

class CommentController extends AbstractActionController {

    /**
     * @var  CommentForm
     */
    protected $form;

    /**
     * @var CommentService
     */
    protected $commentService;

    public function setCommentForm(CommentForm $form) {
        $this->form = $form;
    }

    public function getCommentForm() {
        return $this->form;
    }
    
    /**
     * @param type CommentService
     */
    public function setCommentService(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    
    /**
     * @return CommentService 
     */
    public function getCommentService()
    {
        return $this->commentService;
    }
    
    public function processAction()
    {       
        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute('contact');
        }

        $post = $this->request->getPost();       
        $comment = $this->getCommentService()->addComment($post);
        
        if ($comment == FALSE) {
             $this->flashMessenger()->addMessage('Problem with Comment');
             return $this->redirect()->toUrl($post->url);
        }

        $this->flashMessenger()->addMessage('Comment success.');
        return $this->redirect()->toUrl($post->url);
    }


}
