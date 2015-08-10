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
        foo();

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

    /**
     * @Route("/parse", name="parse")
     */ 

    public function indexParse()
    {   
        //relative path log-Parser\web
        $log_file = 'access_test.log';
        $pattern = '/^(?<client>\S+) +(?<clientid>\S+) +(?<userid>\S+) \[(?<datetime>[^\]]+)\] "(?<method>[A-Z]+)(?<request>[^"]+)?HTTP\/[0-9.]+" (?<status>[0-9]{3}) (?<size>[0-9]+)/';
        $file_handle = fopen($log_file, "r");

        $handle = fopen($log_file, "r");
        if ($handle) {  
            while (($line = fgets($handle)) !== false) {
                
                $entry = new Entry();

                // process the line read.
                preg_match_all($pattern,$line,$matches);
                //var_dump($matches);
                //var_dump($matches['client']);

                foreach($matches['client'] as $x => $x_value) {
                    $entry->setClient($x_value);
                    echo 'client'.$x_value;
                }

                foreach($matches['clientid'] as $x => $x_value) {
                    $entry->setClientid($x_value);
                    echo $x_value;
                }

                foreach($matches['userid'] as $x => $x_value) {
                    $entry->setUserid($x_value);
                    echo $x_value;
                }

                            
                foreach($matches['datetime'] as $x => $x_value) {
                     $str = new \DateTime($x_value);
                    $entry->setTimed($str);
                    echo $x_value;
                }

                foreach($matches['method'] as $x => $x_value) {
                    $entry->setMethod($x_value);
                    echo $x_value;
                }

                foreach($matches['request'] as $x => $x_value) {
                    $entry->setRequest($x_value);
                    echo $x_value;
                }

                foreach($matches['status'] as $x => $x_value) {
                    $entry->setStatusCode($x_value);
                    echo $x_value;
                }

                foreach($matches['size'] as $x => $x_value) {
                    $entry->setSize($x_value);
                    echo $x_value;
                }

                $em = $this->getDoctrine()->getManager();

                $em->persist($entry);
                $em->flush();                
             
            }
            fclose($handle);
        } else {
            // error opening the file.
        }  
        return new Response('success!');

    }    


}