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
include_once '../object/event.php';
 
// passes database values to the database object, grabs returned connection and passes it to the users object. 
$events = new event();

// make sure needed data is submitted
if(
    !empty($_POST["eventName"]) &&
    !empty($_POST["eventstart"]) &&
    !empty($_POST["eventstop"]) &&
    !empty($_POST["description"])
   // !empty($_POST["userID"])
){

    // set event property values
    $events->eventName = $_POST["eventName"];
    $events->eventstart = $_POST["eventstart"];
    $events->eventstop = $_POST["eventstop"];
    $events->description = $_POST["description"];
   // $events->description = $_POST["userID"];

    
        // create the event with users->event
        if($events->createEvent()){
        
            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(array("message" => "event was added."));
        }

        // if unable to create the event, tell the user
        else{

            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to add event."));
        }
}
// if unable to create the event, tell the user
else{

    http_response_code(401);

    // tell the user
    echo json_encode(array("message" => "Unauthorized Access"));
}
