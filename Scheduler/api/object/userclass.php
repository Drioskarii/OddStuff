<?php
include_once '../conn.php';
class userclass extends mySql{
 
    // variables the users object can contain
    private $conn;
    private $userClass;

    // constructor with $db as database connection
    public function __construct(){
        $this->conn = $this->getConnection();
    }
    function classlist(){
        // query get the salt for the specific username
         $query = "SELECT 
                        * 
                    FROM 
                        userClass
                    WHERE
                        classID > :userClass";

     // prepare query
     $stmt = $this->conn->prepare($query);
     $this->userClass=htmlspecialchars(strip_tags($_SESSION["userClass"]));
     $stmt->bindParam(":userClass", $this->userClass);     

     // execute query
     $stmt->execute();

     return $stmt;
 }
}
?>
