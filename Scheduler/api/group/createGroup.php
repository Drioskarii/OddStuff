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
include_once '../object/group.php';
 
// passes database values to the database object, grabs returned connection and passes it to the users object. 
$groups = new group();
if (isset($_SESSION["userID"]) && $_SESSION["userClass"] < 3) {
// make sure needed data is submitted
    if(
        !empty($_POST["groupID"]) &&
        !empty($_POST["groupName"])
    ){
        // set login property values
        $groups->groupID = $_POST["groupID"];
        $groups->groupName = $_POST["groupName"];
        
            // create the login with users->createLogin
            if($groups->createGroup()){
            
                // set response code - 201 created
                http_response_code(201);

                // tell the user
                echo json_encode(array("message" => "group was added."));
            }

            // if unable to create the login, tell the user
            else{

                // set response code - 503 service unavailable
                http_response_code(503);

                // tell the user
                echo json_encode(array("message" => "Unable to add group."));
            }
            
        }
        else{
            http_response_code(401);

        // tell the user
        echo json_encode(array("message" => "Parameters are not met"));
        }

        }
        
    // if unable to create the login, tell the user
    else{

        http_response_code(401);

        // tell the user
        echo json_encode(array("message" => "Unauthorized Access"));
    }
