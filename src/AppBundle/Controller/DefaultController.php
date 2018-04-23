<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        $content = $this
            ->get('templating')
            ->render('AppBundle:Default:index.html.twig');

        return new Response($content);
    }
    
    public function loadFilesAction()
    {
 
        $content = $this
            ->get('templating')
            ->render('AppBundle:Default:result.html.twig');

        return new Response($content);
    }
}