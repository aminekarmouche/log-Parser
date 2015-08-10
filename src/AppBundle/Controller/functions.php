<?php
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Entry;

function load_data_infile(Doctrine\DBAL\Connection $em){
        

        //load data into file
        $sql = "START TRANSACTION; LOAD DATA INFILE '/Users/Amine/Desktop/access_test.log' INTO TABLE test
        FIELDS TERMINATED BY ' ' 
        OPTIONALLY ENCLOSED BY '';
        COMMIT;";   
        $stmt = $cnx->prepare($sql);
        $stmt->execute();
        return ('Trasaction completed!'); 	
} 

function parse_and_persist($em)
{
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

                $em->persist($entry);
                $em->flush();                
             
            }
            fclose($handle);
        } else {
            echo "error opening the file.";

        }  
        return('success!');
}