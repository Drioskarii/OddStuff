<?php
include_once '../conn.php';
class login extends mySql{
 
    // variables the users object can contain
    private $conn; 
    public $password;
    public $username;
    public $userID;
    public $userClass;
    public $key;
    public $salt;

    // constructor with $db as database connection
    public function __construct(){
        $this->conn = $this->getConnection();
        
    }
    function userlogin(){
        // query to get username and userID from the username which has the username submitted and the password submitted
        $query = "  select
                        username,
                        userID,
                        userClass
                    from
                        login
                    WHERE
                        username=:username &&
                        password=AES_ENCRYPT(:password,:key);";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize values
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->key=htmlspecialchars(strip_tags($this->key));
        $this->username=htmlspecialchars(strip_tags($this->username));

        // bind values
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":key", $this->key);
        $stmt->bindParam(":username", $this->username);
 
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    function createLogin(){
 
        // query to insert user into database
        $query = "  INSERT
                    INTO
                        login
                    SET
                        username=:username,
                        password=AES_ENCRYPT(:password,:key),
                        email=:email,
                        salt=:salt";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize values
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->key=htmlspecialchars(strip_tags($this->key));
        $this->salt=htmlspecialchars(strip_tags($this->salt));

        // bind values
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":key", $this->key);
        $stmt->bindParam(":salt", $this->salt);

 
        // execute query
        if($stmt->execute()){
            return true;
        }
 
        return false;
     
    }
     // gets salt for specific username
     function getSalt(){
 
        // query get the salt for the specific username
        $query = "  SELECT 
                        salt
                    FROM   
                        login
                    WHERE  
                        username = :username  ";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize values
        $this->username=htmlspecialchars(strip_tags($this->username));
        // bind values
        $stmt->bindParam(":username", $this->username);
 
        // execute query
        $stmt->execute();
    
        return $stmt;
     
    }
    function userlist(){
           // query to get userlist
            $query = "  SELECT 
                            login.userID,
                            login.username,
                            login.userClass,
                            groupMembers.groupName
                        FROM   
                            login
                        LEFT JOIN 
                            userClass
                        ON
                            userClass.classID = login.userClass
                        LEFT JOIN
                            (SELECT groupMembers.userID, groups.groupName FROM groupMembers LEFT JOIN groups on groups.groupID = groupMembers.groupID ";

                        if ($_SESSION["userClass"] == 2) {
                            $query .= " WHERE groupMembers.groupID = (SELECT groupID from groupMembers WHERE userID = :userID) ";
                        };

            $query .= " ) AS groupMembers
                            ON groupMembers.userID = login.userID WHERE login.userID != :userID";

                        if ($_SESSION["userClass"] == 2) {
                            $query .=  " AND groupMembers.userID = login.userID AND login.userClass > 2";
                        };

        // prepare query
        $stmt = $this->conn->prepare($query);

                // sanitize values
            $this->userID=htmlspecialchars(strip_tags($_SESSION["userID"]));
            $stmt->bindParam(":userID", $this->userID);            

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function updateClass(){
        // query get the salt for the specific username
        $query = " UPDATE
                       login
                   SET
                       userClass = :userClass
                   WHERE
                       login.userID = :userID";
     // prepare query
     $stmt = $this->conn->prepare($query);
    // sanitize values
    $this->userClass=htmlspecialchars(strip_tags($this->userClass));
    $this->userID=htmlspecialchars(strip_tags($this->userID));
    // bind values
    $stmt->bindParam(":userClass", $this->userClass);
    $stmt->bindParam(":userID", $this->userID);
        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
        }
}
?>