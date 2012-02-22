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
        return $this->render('EnricoBlogBundle:Page:index.html.twig');
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
            // Perform some action, such as sending an email

            // Redirect - This is important to prevent users re-posting
            // the form if they refresh the page
            return $this->redirect($this->generateUrl('EnricoBlogBundle_contact'));
        }
    }

    return $this->render('EnricoBlogBundle:Page:contact.html.twig', array(
        'form' => $form->createView()
    ));
    }
    
    
    
}
