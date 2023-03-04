<?php

error_reporting(E_ALL);
ini_set("display_errors", "On");

include ('Product.php');
include 'Database.php';
include 'Validation.php';
include 'Book.php';
include 'Dvd.php';
include 'Furniture.php';

// required headers
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type, origin, *");
header("Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS, DELETE, PATCH");

$method = $_SERVER['REQUEST_METHOD'];
switch($method) {
    case "POST":
        try {
        $productInfo = file_get_contents('php://input');
        $productObj = json_decode(($productInfo));
        if (!isset($productObj->type)) {
            throw new Exception('Please Select a product type');
        }
        $type = ucfirst(strtolower($productObj->type));
            $productData = Validate($type, $productObj);
            $createdProduct =  ProductFactory::createProduct($productData);
            $data = $createdProduct ? $createdProduct->getProduct() : '';
            $createdProduct && $createdProduct->save($data);
        }catch(Exception $e) {
            echo json_encode(['status' => 0, 'message' => $e->getMessage()]);
        }
    break;
    
    case "GET":
       Product::getAllProducts();
    break;

    case "PATCH":
         $productInfo = file_get_contents('php://input');
        $productObj = json_decode(($productInfo));
        Product::deleteMassProducts($productObj);
        break;

    case $method == "OPTIONS": 
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
        header("HTTP/1.1 200 OK");
        die();
}

    
    
   
