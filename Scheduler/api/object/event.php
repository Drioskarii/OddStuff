<?php
include_once '../conn.php';
class event extends mySql{
 
    // variables the users object can contain
    private $conn;
    //  private $eventID;
    //  private $eventName;
    //  private $eventstart;
    //  private $eventstop;
    //  private $eventCreated;
    //  private $description;
    //  private $userID;

    // constructor with $db as database connection
    public function __construct(){
        $this->conn = $this->getConnection();
    }
    function eventList(){
        // query get the salt for the specific username
         $query = "SELECT 
                        * 
                    FROM 
                        events";

     // prepare query
     $stmt = $this->conn->prepare($query);

     // execute query
     $stmt->execute();

     return $stmt;
 }

    function createEvent(){
        // query get the salt for the specific username
         $query = 'INSERT
         INTO
             events
         SET
             eventName=:eventName,
             eventstart=:eventstart,
             eventstop=:eventstop,
             description=:description,
             userID=1';

                        

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize values
  //  $this->eventID=htmlspecialchars(strip_tags($this->eventID));
    $this->eventName=htmlspecialchars(strip_tags($this->eventName));
    $this->eventstart=htmlspecialchars(strip_tags($this->eventstart));
    $this->eventstop=htmlspecialchars(strip_tags($this->eventstop));
 //   $this->eventCreated=htmlspecialchars(strip_tags($this->eventCreated));
    $this->description=htmlspecialchars(strip_tags($this->description));
 //   $this->userID=htmlspecialchars(strip_tags($this->userID));

    // bind values
   // $stmt->bindParam(":eventID", $this->eventID);
    $stmt->bindParam(":eventName", $this->eventName);
    $stmt->bindParam(":eventstart", $this->eventstart);
    $stmt->bindParam(":eventstop", $this->eventstop);
    //$stmt->bindParam(":eventCreated", $this->eventCreated);
    $stmt->bindParam(":description", $this->description);
    //$stmt->bindParam(":userID", $this->userID);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;
    }
}
?>