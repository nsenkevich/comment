<?php

namespace Comment\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator\ClassMethods;
use Application\Service\Filemanager;
use Comment\Repository\Comment as CommentRepository;
use Comment\Form\CommentForm;
use Comment\Entity\Comment;
class Comment implements ServiceManagerAwareInterface
{
    /**
     * @var CommentForm 
     */
    protected $commentForm;
    
    /**
     * @var Filemanager
     */
    protected $filemanagerService;
    /**
     * @var CommentRepository
     */
    protected $repository;
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     *
     * @param Filemanager $filemanagerService
     * @return User 
     */
    public function setFilemanagerService(Filemanager $filemanagerService)
    {
        $this->filemanagerService = $filemanagerService;
        return $this;
    }

    /**
     *
     * @param CommentRepository $repository
     * @return Comment 
     */
    public function setRepository(CommentRepository $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     *
     * @param User $user
     * @return array 
     */
    public function getUserComments(User $user)
    {
        return $this->repository->getUserComments($user);
    }

    /**
     *
     * @param Project $project
     * @return array 
     */
    public function getProjectComments(Project $project)
    {
        return $this->repository->getProjectComments($project);
    }

    /**
     *
     * @param type $id
     * @return Comment 
     */
    public function getComment($id)
    {
        return $this->repository->find($id);
    }

    /**
     *
     * @return array 
     */
    public function getCommentAll()
    {
        return $this->repository->findAll();
    }

    // per Comment we allso will have comments, files, and orders

    /**
     *
     * @param Comment $comment
     * @return File 
     */
    public function getCommentFile(Comment $comment)
    {
        return $this->filemanagerService->getFile($comment);
    }

    /**
     * @return Form
     */
    public function getCommentForm()
    {
//        if (null === $this->commentForm) {
//            $this->commentForm = $this->getServiceManager()->get('comment_form');
//        }
        return $this->commentForm;
    }

    /**
     * @param Form $commentForm
     * @return Comment
     */
    public function setCommentForm(CommentForm $commentForm)
    {
        $this->commentForm = $commentForm;
        return $this;
    }

    public function addComment($data)
    {
        $comment = new Comment();
        $form = $this->getCommentForm();
        $form->setHydrator(new ClassMethods());
        $form->bind($comment);
        $form->setData($data);
        $container = new \Zend\Session\Container();
        if (!$form->isValid()) {
            $container->offsetSet('form_errors', $form->getMessages());
            return false;
        }
        $comment = $form->getData();
        $this->repository->persistEntity($comment);
        return $comment;
    }

    public function getCommentFormRedirection()
    {
        return $this->redirection;
    }

    public function setCommentFormRedirection()
    {
        $this->redirection = $redirection;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $locator
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

}
