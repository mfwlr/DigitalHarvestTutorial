<?php
class ProductData{
 
    // database connection and table name
    private $conn;
    private $table_name = "product_data";
 
    // object properties
    public $pID;
    public $productName;
    public $productImage;
    public $description;
    public $cost;
    public $quantity;
    public $uID;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
 
        // select all query
        $query = "SELECT * FROM " . $this->table_name;
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }
}
?>