<?php

namespace Comment\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Comment\Service\Comment;
use Zend\View\Model\ViewModel;

class CommentList extends AbstractHelper
{
    /**
     *
     * @param type $url
     * @return type 
     */
    public function __invoke($url = NULL)
    {
        //$list = $this->getCommentService()->getCommentAll();
        $list = 'null';
        $vm = new ViewModel(array(
            'url'  => $url,
            'list'  => $list,
        ));

        $vm->setTemplate('comment/comment/list');
        return $this->getView()->render($vm);
    }

    /**
     * Get commentService.
     *
     * @return Comment
     */
    public function getCommentService()
    {
        return $this->commentService;
    }

    /**
     * Set commentService.
     *
     * @param Comment $commentService
     */
    public function setCommentService(Comment $commentService)
    {
        $this->commentService = $commentService;
        return $this;
    }
}
