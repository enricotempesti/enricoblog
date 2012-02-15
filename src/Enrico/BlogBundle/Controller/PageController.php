<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Enrico\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('EnricoBlogBundle:Page:index.html.twig');
    }
    public function aboutAction()
    {
        return $this->render('EnricoBlogBundle:Page:about.html.twig');
    }
    
}
