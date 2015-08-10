<?php

function foo() {
  echo 'bar';
}

public function load_in_file(){
        //get a connection
        $cnx = $this->getDoctrine()->getConnection();

        //load data into file
        $sql = "START TRANSACTION;
        LOAD DATA INFILE '/Users/Amine/Desktop/access_test.log' INTO TABLE test
        FIELDS TERMINATED BY ' ' 
        OPTIONALLY ENCLOSED BY '';
        COMMIT;";   
        $stmt = $cnx->prepare($sql);
        $stmt->execute();
        return ('Trasaction completed!'); 	
} 