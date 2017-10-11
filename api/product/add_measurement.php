<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/product.php';

// Local timezone
date_default_timezone_set('Europe/Istanbul');

 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$product->sensor_value = $data->sensor_value;
$product->measurement_date = date('Y-m-d H:i');
$product->product_id = $data->product_id;


 
// create the product
if($product->addMeasurement()){
	if($data->sensor_value > 0){ 
    echo '{';
        echo '"message": "Veri Ekleme Basarili."';  
    echo '}';
}
 }
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Veri Eklenemiyor!."';
    echo '}';
}


?>