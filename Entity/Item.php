<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 */
class Item
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $itemName;

    /**
     * @var string
     */
    private $itemDesc;


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
     * Set itemName
     *
     * @param string $itemName
     * @return Item
     */
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;

        return $this;
    }

    /**
     * Get itemName
     *
     * @return string 
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * Set itemDesc
     *
     * @param string $itemDesc
     * @return Item
     */
    public function setItemDesc($itemDesc)
    {
        $this->itemDesc = $itemDesc;

        return $this;
    }

    /**
     * Get itemDesc
     *
     * @return string 
     */
    public function getItemDesc()
    {
        return $this->itemDesc;
    }
}
