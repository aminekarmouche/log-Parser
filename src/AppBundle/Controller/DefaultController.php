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
     * @Route("/logparse", name="logparse")
     */
    public function indexLogParse(Request $request)
    {
        $entry = new Entry();
        $entry->setClient('A Foo Bar');
        $entry->setUserid('-');
        $entry->setClientid('-');
        $str = new \DateTime('12569537329');
        $entry->setTimed($str);

        $entry->setMethod('GET');
        $entry->setRequest('Homepage');
        $entry->setStatusCode('200');
        $entry->setSize('5000');

        $em = $this->getDoctrine()->getManager();

        $em->persist($entry);
        $em->flush();

        return new Response('Created entry id '.$entry->getId());
    }


    /**
     * @Route("/load", name="load")
     */ 

    public function load()
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

        return new Response('success parsing and persisting the data!');
    }    
}