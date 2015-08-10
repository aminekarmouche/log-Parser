<?php
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Entry;

function load_data_infile(Doctrine\DBAL\Connection $cnx){
        

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
         
            while (($line = fgets($handle)) !== false) {
                
                $entry = new Entry();

                // process the line read.
                preg_match_all($pattern,$line,$matches);

                	
                	$entry->setClient(@$matches['client'][0]);
                	$entry->setClientid(@$matches['clientid'][0]);
                	$entry->setUserid(@$matches['userid'][0]);
                    $str = new \DateTime(@$matches['datetime'][0]);
                    $entry->setTimed($str);
                    $entry->setMethod(@$matches['method'][0]);                	
                	$entry->setRequest(@$matches['request'][0]);
                	$entry->setStatusCode(@$matches['status'][0]);
                	$entry->setSize(@$matches['size'][0]);
				

				$em->persist($entry);
                $em->flush();                
             
            }
            fclose($handle);
       
        return('success!');
}