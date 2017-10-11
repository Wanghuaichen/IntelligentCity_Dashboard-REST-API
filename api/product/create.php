<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/database.php';
 include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$product->name = $data->name;
$product->sensor_value = $data->sensor_value;
$product->description = $data->description;
$product->category_id = $data->category_id;
$product->created = date('Y-m-d H:i');
 
// create the product
if($product->create()){
    echo '{';
        echo '"message": "Veri Ekleme Basarili."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Veri Eklenemiyor!."';
    echo '}';
}


?>