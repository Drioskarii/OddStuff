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
include_once '../object/userclass.php';
 
// passes database values to the database object, grabs returned connection and passes it to the users object. 
$userclass = new userclass();
        // run query on userclass->classlist
        $stmt = $userclass->classlist();
        $num = $stmt->rowCount();
    
        // check if more than 0 record found
        if($num>0){
            $class_arr=array();
            $class_arr["records"]=array();
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
                
                $class_item=array(
                    "classID" => $classID,
                    "className" => $className
                );
                array_push($class_arr["records"], $class_item);
            }
                http_response_code(201);
 
                // tell the user
                echo json_encode($class_arr);
            
        }else{
    
            http_response_code(400);
 
            // tell the user
            echo json_encode(array("message" => "No users found"));
        }