<?php

namespace Comment\Repository;

use Doctrine\ORM\EntityRepository;
use User\Entity\User;
use Project\Entity\Project;
use Application\Repository\BaseRepositoryAbstract;


class Comment extends BaseRepositoryAbstract
{
        
    public function getUserComments(User $user)
    {
        $query = $this->_em->createQuery("SELECT u FROM Comment\Entity\Comment u WHERE u.userId = :userId");
        $query->setParameters(array('userId' => $user->getUserId()));
        return $query->getResult();
    }
    
    
    public function getProjectComments(Project $project)
    {
        $query = $this->_em->createQuery("SELECT u FROM Comment\Entity\Comment u WHERE u.projectId = :projectId");
        $query->setParameters(array('projectId' => $project->getProjectId()));
        return $query->getResult();
    }
}