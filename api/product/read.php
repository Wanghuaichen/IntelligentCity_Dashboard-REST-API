<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// query products
$stmt = $product->read();
$num = $stmt->rowCount();


 
// check if more than 0 record found
//if($num>0)
if(count($stmt))
{
 
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       
        extract($row);
 
        $product_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "sensor_value" => $sensor_value,
            "category_id" => $category_id,
            "category_name" => $category_name
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
    echo json_encode($products_arr);
}
 
else{
	
    echo json_encode(
        array("message" => "Sensör Bulunamadı")
    );
}


?>