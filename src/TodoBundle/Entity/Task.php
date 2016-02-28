<?php
/**
 * Created by PhpStorm.
 * User: evald
 * Date: 2016-02-26
 * Time: 13:51
 */

namespace TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * src\TodoBundle\Entity\Task
 * @ORM\Table(name="Task")
 * @ORM\Entity
 */
class Task
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="dueDate", type="date")
     */
    public $dueDate;

    /**
     * @ORM\Column(name="title", type="text")
     */
    public $title;

    /**
     * @ORM\Column(name="priority", type="integer")
     */
    public $priority;

    /**
     * @ORM\Column(name="content", type="text")
     */
    public $content;

    /**
     * @ORM\Column(name="assigned", type="text")
     */
    public $assigned;

    /**
     * @ORM\Column(name="isCompleted", type="integer")
     */
    public $isCompleted;

    public function getId(){
        return $this->id;
    }

    public function setDueDate($dueDate){
        $this->dueDate = $dueDate;
    }

    public function getDueDate(){
       return $this->dueDate;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setPriority($priority){
        $this->priority = $priority;
    }

    public function getPriority(){
        return $this->priority;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function getContent(){
        return $this->content;
    }

    public function setAssigned($assigned){
        $this->assigned = $assigned;
    }

    public function getAssigned(){
        return $this->assigned;
    }

    public function setIsCompleted($isCompleted){
        $this->isCompleted = $isCompleted;
    }

    public function getIsCompleted(){
        return $this->isCompleted;
    }
}