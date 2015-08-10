<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Entry;
use Acme\ToolBundle\Parser;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $parser = new Parser();
        $parser->hello();

        return new Response('success!');
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
        //get the connection 
        $cnx = $this->getDoctrine()->getConnection();
        //load data into file
        $sql = "START TRANSACTION;
        LOAD DATA INFILE '/Users/Amine/Desktop/access_test.log' INTO TABLE test
        FIELDS TERMINATED BY ' ' OPTIONALLY ENCLOSED BY '';
        COMMIT;";   

        $stmt = $cnx->prepare($sql);
        $stmt->execute(); 
        return new Response('success!');

    }


}