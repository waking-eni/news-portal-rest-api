<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/administrator.php';
  
// instantiate database and admin object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$admin = new Administrator($db);
  
// query admins
$stmt = $admin->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num > 0){
  
    // admins array
    $admin_arr = array();
    $admin_arr["records"] = array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $admin_item = array(
            "id" => $id,
            "name" => $id,
            "surname" => $id,
            "username" => $name,
            "email" => $units
        );
  
        array_push($admin_arr["records"], $admin_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show users data in json format
    echo json_encode($admin_arr);
} else {
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no admins found
    echo json_encode(
        array("message" => "No admins found.")
    );
}