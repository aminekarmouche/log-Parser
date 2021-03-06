<?php
namespace AppBundle\Utils;

use Doctrine\DBAL\Connection;

class Loader
{
    public function load($connection)
    {
        //load data into file
        $sql = "START TRANSACTION;
                LOAD DATA INFILE '/Users/Amine/Desktop/access_test.log' 
                INTO TABLE test
                FIELDS TERMINATED BY ' ' 
                OPTIONALLY ENCLOSED BY '';
                COMMIT;";

        //prepare connection  
        $sql_statement = $connection->prepare($sql);
        $sql_statement->execute();
        
        return ('Trasaction completed!');
    }
}
