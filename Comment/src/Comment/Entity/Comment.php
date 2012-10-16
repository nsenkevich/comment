<?php

namespace Comment\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Comment\Repository\Comment")
 * @ORM\Table(name="comment")
 */
class Comment {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $commentId;

//    /**
//     * @ORM\ManyToOne(targetEntity="Project");
//     * @ORM\JoinColumn(name="projectId", referencedColumnName="projectId");
//     */
//    protected $project;

    /**
     * @ORM\Column(type="string")
     */
    protected $projectId;

    /**
     * @ORM\Column(type="string")
     */
    protected $comment;

    /**
     * @ORM\Column(type="string")
     */
    protected $dtc;


    public function getCommentId() {
        return $this->commentId;
    }

    public function setCommentId($commentId) {
        $this->commentId = (int) $commentId;
        return $this;
    }

    public function getProjectId() {
        return $this->projectId;
    }

    public function setProjectId($projectId) {
        $this->projectId = (int) $projectId;
        return $this;
    }
    
    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }
    
    public function getDtc() {
        return $this->dtc;
    }

    public function setDtc($dtc) {
        $this->dtc = $dtc;
        return $this;
    }

}

