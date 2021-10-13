<?php
include_once '../conn.php';
class group extends mySql{
 
    // variables the users object can contain
    private $conn;

    // constructor with $db as database connection
    public function __construct(){
        $this->conn = $this->getConnection();
    }
    function grouplist(){
        // query get the salt for the specific username
         $query = "SELECT 
                        * 
                    FROM 
                        groups";

     // prepare query
     $stmt = $this->conn->prepare($query);

     // execute query
     $stmt->execute();

     return $stmt;
 }
 function createGroup(){
 
    // query to insert user into database
    $query = "  INSERT
                INTO
                    groups
                SET
                    groupID=:groupID,
                    groupName=:groupName";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize values
    $this->groupID=htmlspecialchars(strip_tags($this->groupID));
    $this->groupName=htmlspecialchars(strip_tags($this->groupName));

    // bind values
    $stmt->bindParam(":groupID", $this->groupID);
    $stmt->bindParam(":groupName", $this->groupName);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;
    }
}
?>
