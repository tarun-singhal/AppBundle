<?php 
namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
class SitemapEvent extends Event
{
    private $pages = array();
    private $time = array();
    
    public function addPage($path, $modified)
    {
        $this->pages[] = array(
            'path' => $path,
            'modified' => $modified
        );
    }
    
    public function getPages()
    {
        return $this->pages;
    } 

    public function getUserLog()
    {
        return $this->time;
    }
    
    public function addUserLog($time)
    {
        $this->time[] = array('time' => $time);
    }
}