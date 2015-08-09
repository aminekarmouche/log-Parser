<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

        /**
     * @Route("/parse", name="parse")
     */
    public function indexParse(Request $request)
    {
        return new Response('Parsing the log file and storing Entry objects in DB!');
    }

    /**
     * @Route("/logparse", name="logparse")
     */
    public function indexLogParse(Request $request)
    {
        return new Response('Parsing and putting directly in MYSQL!');
    }


}
