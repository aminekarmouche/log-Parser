<?php
use AppBundle\Entity\Entry;

/**
     * @param Doctrine\DBAL\Connection $cn Doctrine Database Connection
     * 
     * @return string A message! 
     */

function load_data_infile(Doctrine\DBAL\Connection $connection)
{        
    //load data into file
    //include your log file path!
    $sql = "START TRANSACTION; LOAD DATA INFILE '/Users/Amine/Desktop/access_test.log' INTO TABLE test
    FIELDS TERMINATED BY ' ' 
    OPTIONALLY ENCLOSED BY '';
    COMMIT;"; 

    //prepae connection  
    $sql_statement = $connection->prepare($sql);
    $sql_statement->execute();
    return ('Trasaction completed!'); 	
} 

/**
     * @param Doctrine\DBAL\Connection $manager Doctrine Connection anager
     *
     * @return string Confirmation Message
     */
function parse_and_persist($manager)
{
	$log_file = 'access_test.log';
	$pattern = '/^(?<client>\S+) +(?<clientid>\S+) +(?<userid>\S+) \[(?<datetime>[^\]]+)\] "(?<method>[A-Z]+)(?<request>[^"]+)?HTTP\/[0-9.]+" (?<status>[0-9]{3}) (?<size>[0-9]+)/';
	$file_handle = fopen($log_file, "r");
	$line = fgets($file_handle);
	preg_match_all($pattern,$line,$matches);
	

	return ($matches[0][0]);

	while (!feof($file_handle)){
	   $line = fgets($file_handle);

		//new entry instance
        $entry = new Entry();
		
        //look for pattern in line
        preg_match_all($pattern,$line,$matches);

        //populate entry
    	$entry->setClient(@$matches['client'][0]);
    	$entry->setClientid(@$matches['clientid'][0]);
    	$entry->setUserid(@$matches['userid'][0]);
        $str = new \DateTime(@$matches['datetime'][0]);
        $entry->setTimed($str);
        $entry->setMethod(@$matches['method'][0]);                	
    	$entry->setRequest(@$matches['request'][0]);
    	$entry->setStatusCode(@$matches['status'][0]);
    	$entry->setSize(@$matches['size'][0]);

		if (@$matches['client'][0] != null){
            //persist entry to DB
        	$manager->persist($entry);
			$manager->flush();
        } else {
        	break;
        	fclose($file_handle);
        }
	}

        return('log file parsed successfully!');
}