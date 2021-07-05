<?php

 
$dsn = "pgsql:host=localhost;port=5433;dbname=TP3;user=postgres;password=pedro99";
 
try{
 // create a PostgreSQL database connection
 $conn = new PDO($dsn);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
 
 // display a message if connected to the PostgreSQL successfully
 if($conn){
 echo "Connected to the database successfully!";
 }
}catch (PDOException $e){
 // report error message
 echo $e->getMessage();
}

?>