<?php

namespace Comment\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Comment\Form\CommentForm,
    Zend\View\Model\ViewModel;

class CommentAdd extends AbstractHelper
{
    /**
     * Comment Form
     * @var CommentForm
     */
    protected $commentForm;
    
    /**
     * __invoke 
     * 
     * @access public
     * @param array $options array of options
     * @return string
     */
    public function __invoke($url, $parentId)
    {
        $form = $this->getCommentForm();
        $form->get('url')->setAttribute('value', $url);
        
        $container = new \Zend\Session\Container();
        $errors = $container->offsetGet('form_errors');
        if (isset($errors)){
            $form->setMessages($errors);
        } 
        $container->offsetUnset('form_errors');
        $vm = new ViewModel(array(
            'form' => $form,
            'url'  => $url,
            'parentId'  => $parentId,
        ));

        $vm->setTemplate('comment/comment/index');
        return $this->getView()->render($vm);
    }
    
    /**
     * Retrieve Comment Form Object
     * @return CommentForm
     */
    public function getCommentForm()
    {
        return $this->commentForm;
    }

    /**
     * Inject Comment Form Object
     * @param CommentForm $commentForm
     * @return CommentAdd
     */
    public function setCommentForm(CommentForm $commentForm)
    {
        $this->commentForm = $commentForm;
        return $this;
    }
}
