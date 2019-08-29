<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
//includes for other files
include_once '../config/database.php';
include_once '../objects/product_data.php';
 
//Set up database connection
$database = new Database();
$db = $database->getConnection();
 
// Create a ProductData to hold the information
$theProduct = new ProductData($db);
 
// Get all the products available
$stmt = $theProduct->read();
$num = $stmt->rowCount();
 
// If we have products
if($num>0){
 
    // products array
    $allProducts=array();
    $allProducts["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $aProduct=array(
            "pID" => $pID,
            "productName" => $productName,
            "productImage" => $productImage,
            "description" => html_entity_decode($description),
            "cost" => $cost,
            "quantity" => $quantity,
            "uID" => $uID
        );
 
        array_push($allProducts["records"], $aProduct);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // Use  json format so that REST API use is easy
    echo json_encode($products_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "The Harvest is empty - come back soon.")
    );
}