<?php
// displays errors, very useful when coding.
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

// sets headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
session_start();

// include database and object files
include_once '../object/login.php';
 
// passes database values to the database object, grabs returned connection and passes it to the users object. 
$login = new login();

// make sure needed data is submitted
if(
    !empty($_POST["username"]) &&
    !empty($_POST["password"])
){
    // set login property values
    $login->username = $_POST["username"];
    $login->password = $_POST["password"];

    // run query that returns the salt for the specified username
    $stmt = $login->getSalt();
    $num = $stmt->rowCount();
 
    // check if more than 0 record found
    if($num>0){
        // gets row from returned data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set remaining login property values
        $login->key = hash_pbkdf2("sha256", $_POST["password"], $row["salt"], 100, 50);

        // run query on users->userlogin
        $stmt = $login->userlogin();
        $num = $stmt->rowCount();
    
        // check if more than 0 record found
        if($num==1){
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
                
                $_SESSION["userClass"] = $userClass;
                $_SESSION["userID"] = $userID;
                http_response_code(201);
 
                // tell the user
                echo json_encode(array("message" => "Login Successful"));
            }
            
            
        }else{
    
            http_response_code(400);
 
            // tell the user
            echo json_encode(array("message" => "Unable to login. submitted Data is incomplete2."));
        }
    }
 
    // if unable to create the login, tell the user
    else{
 
        http_response_code(400);
 
        // tell the user
        echo json_encode(array("message" => "Unable to login. submitted Data is incomplete3."));
    }
}
else {
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to login. submitted Data is incomplete4."));
}