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
        // run query on login->userlist
        $stmt = $login->userlist();
        $num = $stmt->rowCount();
    
        // check if more than 0 record found
        if($num>0){
            $user_arr=array();
            $user_arr["records"]=array();
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
                
                $user_item=array(
                    "userID" => $userID,
                    "username" => $username,
                    "userClass" => $userClass,
                    "groupName" => $groupName
                );
                array_push($user_arr["records"], $user_item);
            }
                http_response_code(201);
 
                // tell the user
                echo json_encode($user_arr);
            
        }else{
    
            http_response_code(400);
 
            // tell the user
            echo json_encode(array("message" => "No users found"));
        }
   } else 
   {
    http_response_code(401);

    // tell the user
    echo json_encode(array("message" => "Unauthorized Access"));
   }