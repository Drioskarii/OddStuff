<?php
class mySql {

    // creates connection to database and returns the connection.
    public function getConnection(){
 
        $conn = null;
 
        try{
            $conn = new PDO("mysql:host=" . getenv('ip') . ";dbname=" . getenv('database'), getenv('login'), getenv('password'));
            $conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $conn;
    }
}
?>
