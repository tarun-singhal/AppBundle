<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * task
 */
class task
{
    /**
     * @var integer
     */
    private $id;

    /**
     * 
     * @Assert\NotBlank()
     * @Assert\Length(min=3)(message = "Please provide Task name with min of 3 char.")
     *
     * @var string
     */
    private $task;

    /**
     * @var \DateTime
     */
    private $dueDate;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set task
     *
     * @param string $task
     * @return task
     */
    public function setTask($task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return string 
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return task
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }
}
