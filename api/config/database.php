<?php
class Database{
 

    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("sqlsrv:server = tcp:fatihsqlsrv.database.windows.net,1433; Database = fatihdbtest", "fatihdbtest", "sifre123*");
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>