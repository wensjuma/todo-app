<?php
// Headers
//RewriteRule ^create/task/([^/]*)$ /create.php?item=$1 [L]
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once 'config/Database.php';
include_once 'models/assign.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$output = array();
// Instantiate Todo object
$todo = new Assign($db);


$data = json_decode(file_get_contents("php://input"));

$todo->assign = $data->todo_id;
$todo->user = $data->user_id;
// Create Task
if ($todo->assignUser()) {
    $output['status'] = 201;
    $output['message'] = "Task  Assigned";
} else {
    $output['status'] = 204;
    $output['message'] = "Task Not Assigned";
}

// Turn to JSON & output
echo json_encode($output);
