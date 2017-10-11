<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

include_once '../config/database.php';
include_once '../objects/product.php';
 

$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Product($db);

if(isset($_GET['id'])){
	
	$product->id = $_GET['id'];
	} else {
		echo json_encode(
        array("message" => "Sensor ID Hatalı"));
		die();
		}


 
// query products
$stmt = $product->readOneSensorData();
$num = $stmt->rowCount();


 
// check if more than 0 record found
//if($num>0)
if(count($stmt))
{
 
    // products array
    $products_arr=array();
    $products_arr["sensor_values"]=array();
 
	    // Kendime not : http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       
        extract($row);
 
        $product_item=array(
            "measurement_id" => $measurement_id,
			"category_id" => $category_id,
			"sensor_name" => $name,
            "sensor_value" => $sensor_value,
            "measurement_date" => $measurement_date,
			"category_name" => $category_name,
        );
 
        array_push($products_arr["sensor_values"], $product_item);
    }
 
    echo json_encode($products_arr);
}
 
else{
	
    echo json_encode(
        array("message" => "Veri Yok.")
    );
}


?>