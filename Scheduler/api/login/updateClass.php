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
   if (isset($_SESSION["userID"]) && $_SESSION["userClass"] < 3) {
      if(
         !empty($_POST["userID"]) &&
         !empty($_POST["userClass"])
     ){
         // set login property values
         $login->userID = $_POST["userID"];
         $login->userClass = $_POST["userClass"];
         
             // create the login with users->createLogin
             if($login->updateClass()){
             
                 // set response code - 201 created
                 http_response_code(201);
     
                 // tell the user
                 echo json_encode(array("message" => "User class has been updated."));
             }
     
             // if unable to create the login, tell the user
             else{
     
                 // set response code - 503 service unavailable
                 http_response_code(503);
     
                 // tell the user
                 echo json_encode(array("message" => "Unable to update user class."));
             }
     }
     // if unable to create the login, tell the user
     else{
        http_response_code(401);

        // tell the user
        echo json_encode(array("message" => "Variables missing"));
     }
     

   } else 
   {
    http_response_code(401);

    // tell the user
    echo json_encode(array("message" => "Unauthorized Access"));
   }