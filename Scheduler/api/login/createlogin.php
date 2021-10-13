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
    !empty($_POST["password"]) &&
    !empty($_POST["email"])
){
    // set login property values
    $login->username = $_POST["username"];
    $login->password = $_POST["password"];

    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    
        //generates a random salt string
        $login->username = $_POST["username"];
        $login->password = $_POST["password"];
        $login->email = $_POST["email"];
        $salt = bin2hex(random_bytes(16));
        // set login property values
        $login->salt = $salt;
        // hashes the password
        $login->key = hash_pbkdf2("sha256", $_POST["password"], $salt, 100, 50);
    
        // create the login with users->createLogin
        if($login->createLogin()){
        
            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(array("message" => "login was added."));
        }

        // if unable to create the login, tell the user
        else{

            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to add login."));
        }
    } else {
        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Email isn't valid"));
    }
}
// if unable to create the login, tell the user
else{

    http_response_code(401);

    // tell the user
    echo json_encode(array("message" => "Unauthorized Access"));
}
