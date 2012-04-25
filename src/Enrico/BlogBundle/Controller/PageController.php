<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Enrico\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Import new namespaces
use Enrico\BlogBundle\Entity\Enquiry;
use Enrico\BlogBundle\Form\EnquiryType;

class PageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $blogLimit   = $this->container
                           ->getParameter('enrico_blog.blog._limit');
        $blogs = $em->getRepository('EnricoBlogBundle:Blog')
                         ->getLatestBlogs($blogLimit);

        return $this->render('EnricoBlogBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
    }
    
    public function aboutAction()
    {
        return $this->render('EnricoBlogBundle:Page:about.html.twig');
    }
    
   
    public function contactAction()
    {
    $enquiry = new Enquiry();
    $form = $this->createForm(new EnquiryType(), $enquiry);

    $request = $this->getRequest();
    if ($request->getMethod() == 'POST') {
        $form->bindRequest($request);

        if ($form->isValid()) {
        	
            $message = \Swift_Message::newInstance()
            ->setSubject('Contacto da enricoBlog')
            ->setFrom('enquiries@symblog.co.uk')
            ->setTo($this->container->getParameter('Enrico_blog.emails.contact_email'))
            ->setBody($this->renderView('EnricoBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
        $this->get('mailer')->send($message);

        $this->get('session')->setFlash('enrico-notice','La tua richiesta è stata spedita con successo!');

        // Redirect - This is important to prevent users re-posting
        // the form if they refresh the page
            return $this->redirect($this->generateUrl('EnricoBlogBundle_contact'));
        }
    }

    return $this->render('EnricoBlogBundle:Page:contact.html.twig', array(
        'form' => $form->createView()
    ));
    }
    
    public function nuovo_blogAction()
    
    {
    return $this->render('EnricoBlogBundle:Page:nuovo_blog.html.twig');
    }
    
    
    public function sidebarAction()
    {
    $em = $this->getDoctrine()
               ->getEntityManager();

    $tags = $em->getRepository('EnricoBlogBundle:Blog')
               ->getTags();

    $tagWeights = $em->getRepository('EnricoBlogBundle:Blog')
                     ->getTagWeights($tags);
    
        $commentLimit   = $this->container
                           ->getParameter('enrico_blog.comments.latest_comment_limit');
    $latestComments = $em->getRepository('EnricoBlogBundle:Comment')
                         ->getLatestComments($commentLimit);

    return $this->render('EnricoBlogBundle:Page:sidebar.html.twig', array(
        'latestComments'    => $latestComments,
        'tags'              => $tagWeights
    ));
    
    }
    
    
    
    
    
}
