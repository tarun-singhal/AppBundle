<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use AppBundle\Event\SitemapEvent;
use Symfony\Component\Validator\Constraints\Date;

class AppBundle extends Bundle
{
    public function onSitemapEvent(SitemapEvent $event) {
//         die('service 222');
        // Get blog posts..
        $event->addPage('/hello', 'new event');
//         foreach ($posts as $post) {
//             $slug = sprintf('/blog/%s', $post->getSlug());
//             $event->addPage($slug, $post->getLastModified());
//         }
    }
    
    public function onUserSiteMap(SitemapEvent $event)
    {
        $event->addUserLog(date('Y-m-d h:i:s'));
    }
    
    
}
