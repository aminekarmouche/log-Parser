<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Entry;

require 'functions.php';


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {


        return new Response('Hello There!!');
    }

    /**
     * @Route("/load", name="load")
     */ 

    public function indexLoad()
    {
        //get a connection
        $cnx = $this->getDoctrine()->getConnection();

        return new Response(load_data_infile($cnx));
    }

    /**
     * @Route("/parse", name="parse")
     */ 

    public function indexParse()
    {
        //get doctrine manager to persist data 
        $em = $this->getDoctrine()->getManager();
        parse_and_persist($em);

        return new Response(parse_and_persist($em));
    }    
}