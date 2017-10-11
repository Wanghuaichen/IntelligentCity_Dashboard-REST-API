<?php
class Product{
 
    private $conn;
    private $table_name = "products";
	private $measurement_table_name = "sensor_values";

 
    // object properties
    public $id;
    public $name;
    public $description;
    public $sensor_value;
    public $category_id;
    public $category_name;
    public $created;
 
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read products
function read(){
 
    // select all query
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.sensor_value, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY
                p.created DESC";
 
    $stmt = $this->conn->prepare($query);
 
    $stmt->execute();
 
    return $stmt;
} // End of read()

// create product
function create(){
 
    // query to insert record
 	
	$query = "INSERT INTO ".$this->table_name." (name, description, sensor_value, category_id, created) VALUES (:name, :description, :sensor_value, :category_id, :created)";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->sensor_value=htmlspecialchars(strip_tags($this->sensor_value));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->created=htmlspecialchars(strip_tags($this->created));
 
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":sensor_value", $this->sensor_value);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":created", $this->created);
 
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
} // end of create


//add measurement
function addMeasurement(){
 
	$query = "INSERT INTO sensor_values (sensor_value, measurement_date, product_id) VALUES (:sensor_value, :measurement_date, :product_id)";
 
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->sensor_value=htmlspecialchars(strip_tags($this->sensor_value));
	$this->measurement_date=htmlspecialchars(strip_tags($this->measurement_date));
    $this->product_id=htmlspecialchars(strip_tags($this->product_id));
	

    // bind values
    $stmt->bindParam(":sensor_value", $this->sensor_value);
    $stmt->bindParam(":measurement_date", $this->measurement_date);
    $stmt->bindParam(":product_id", $this->product_id);

 
    // execute query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
} 
//end of measurement
   
   
    // query to read single record
function readOne(){
 
    $query = "SELECT TOP 1
                c.name as category_name, p.id, p.name, p.description, p.sensor_value, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.id = ?";
 
    $stmt = $this->conn->prepare( $query );
 
    $stmt->bindParam(1, $this->id);
 
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->name = $row['name'];
    $this->sensor_value = $row['sensor_value'];
    $this->description = $row['description'];
    $this->category_id = $row['category_id'];
    $this->category_name = $row['category_name'];
} // end of read one 


// Get one sensor data
function readOneSensorData(){
 
    // select one sensor query
    $query = "SELECT 
               s.measurement_id, s.sensor_value, s.measurement_date,  p.name, c.id as category_id,c.name as category_name
            FROM
                sensor_values s
                LEFT JOIN
				products p ON s.product_id = p.id
				LEFT JOIN
				categories c ON p.category_id = c.id 
            WHERE
                p.id = ? ORDER BY s.measurement_id DESC";
 
    $stmt = $this->conn->prepare($query);
	
    $stmt->bindParam(1, $this->id);
 
    $stmt->execute();
 
    return $stmt;
} // End of one sensor 


function readSensorData(){
 
    // select all query
	 /*$query = "SELECT 
               s.measurement_id, s.sensor_value, s.measurement_date,  p.name
            FROM
                sensor_values s
                LEFT JOIN
                    products p
                        ON s.product_id = p.id"; */
	
    $query = "SELECT 
               s.measurement_id, s.sensor_value, s.measurement_date,  p.name, c.id as category_id,c.name as category_name
            FROM
                sensor_values s
                LEFT JOIN
				products p ON s.product_id = p.id
				LEFT JOIN
				categories c ON p.category_id = c.id";
 
    $stmt = $this->conn->prepare($query);
	 
    $stmt->execute();
 
    return $stmt;
} 
//end of read one sensor



function readSensorBetweenDate($starDate,$endDate,$id){
    $query = "SELECT s.measurement_id,s.sensor_value,s.measurement_date,p.name from dbo.sensor_values s

 LEFT JOIN
                    products p
                        ON product_id = p.id

WHERE measurement_date > {ts '".$starDate."'}
  AND measurement_date < {ts '".$endDate."'} AND p.id = ".$id."";
 
    $stmt = $this->conn->prepare($query);
	
    $stmt->execute();
 
    return $stmt;
} 
//end of read between date








// update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                sensor_value = :sensor_value,
                description = :description,
                category_id = :category_id
            WHERE
                id = :id";
 
    $stmt = $this->conn->prepare($query);
 	// sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->sensor_value=htmlspecialchars(strip_tags($this->sensor_value));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->id=htmlspecialchars(strip_tags($this->id));
 	
	// bind
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':sensor_value', $this->sensor_value);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':category_id', $this->category_id);
    $stmt->bindParam(':id', $this->id);
 
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}  	// end of update 


// delete the product
function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
} 
// end of delete

// search products
function search($keywords){
 
    // select all query
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.sensor_value, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
            ORDER BY
                p.created DESC";
 
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}	
// end of search

// read products with pagination
public function readPaging($from_record_num, $records_per_page){
 
    // select query
    /*$query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.sensor_value, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY p.created DESC
            LIMIT ?, ?";
 */
 

   $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.sensor_value, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY p.created DESC
            OFFSET ? ROWS FETCH NEXT  ? ROWS ONLY";
 
 
 
    $stmt = $this->conn->prepare( $query );
 
    // bind
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    $stmt->execute();
 
    return $stmt;
} 
// end of read paging

// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}


}
