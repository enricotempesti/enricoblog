<?php
// src/Blogger/BlogBundle/Controller/BlogController.php

namespace Enrico\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Blog controller.
 */
class BlogController extends Controller
{
    /**
     * Show a blog entry
     */
    public function showAction($id,$slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('EnricoBlogBundle:Blog')->find($id);

    if (!$blog) {
        throw $this->createNotFoundException('Unable to find Blog post.');
    }

    $comments = $em->getRepository('EnricoBlogBundle:Comment')
                   ->getCommentsForBlog($blog->getId());

    return $this->render('EnricoBlogBundle:Blog:show.html.twig', array(
        'blog'      => $blog,
        'comments'  => $comments
    ));
        
    }
}
