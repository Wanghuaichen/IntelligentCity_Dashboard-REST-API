<?php
//this page copy of read_product  ***************

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

include_once '../config/database.php';
include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);

$sensor_list = json_decode(file_get_contents('http://fatihwebapp.azurewebsites.net/api/product/read.php'));


 
//grap

// Local timezone
date_default_timezone_set('Europe/Istanbul');
 
 
 $today = date('Y-m-d H:i:s');
 $oneWeekAgo = date('Y-m-d 00:00:00', strtotime('-7 days'));
 
 //create all sensor datas in one array
 foreach($sensor_list->records as $sensor){
 
				// query products1 
			$stmt1 = $product->readSensorBetweenDate($oneWeekAgo,$today,"2");
			if(count($stmt1)){
				$product1_item=array();
				while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					$product1_item[]=array(
						"measurement_id" => $measurement_id,
						"sensor_name" => $name,
						"sensor_value" => $sensor_value,
						"measurement_date" => $measurement_date	
					);   
				}
			}
			// query products2 
			$stmt2 = $product->readSensorBetweenDate($oneWeekAgo,$today,"3");
			if(count($stmt2)){
				$product2_item=array();
				while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					$product2_item[]=array(
						"measurement_id" => $measurement_id,
						"sensor_name" => $name,
						"sensor_value" => $sensor_value,
						"measurement_date" => $measurement_date	
					);   
				}
			}
			// query products2 
			$stmt3 = $product->readSensorBetweenDate($oneWeekAgo,$today,"4");
			if(count($stmt3)){
				$product3_item=array();
				while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					$product3_item[]=array(
						"measurement_id" => $measurement_id,
						"sensor_name" => $name,
						"sensor_value" => $sensor_value,
						"measurement_date" => $measurement_date	
					);   
				}
			}

 } // end of json while
 
 
	$sensor_values = array();
	
	
	
//
for($i=0; $i<sizeof($product1_item);$i++){
	
	$sensor_values[] = array("period" =>$product1_item[$i]['measurement_date'],"baca1"=>$product1_item[$i]['sensor_value'],"baca2"=>$product2_item[$i]['sensor_value'],"baca3" => $product3_item[$i]['sensor_value']);
	
	}

echo json_encode($sensor_values);
?>