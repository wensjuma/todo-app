<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once 'category.php';
  
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$category = new Category($db);
  
// query categorys
$stmt = $category->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $categories_arr=array();
    $categories_arr["data"]=array();
  
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $category_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description)
        );
  
        array_push($categories_arr["data"], $category_item);
    }
    // set response code - 200 OK
    http_response_code(200);
    // show categories data in json format
    echo json_encode($categories_arr);
}
else{
  

    http_response_code(404);
  
    // tell the user no categories found
    echo json_encode(
        array("message" => "No categories found.")
    );
}
?>

