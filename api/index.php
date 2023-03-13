<?php

error_reporting(E_ALL);
ini_set("display_errors", "On");

use api\product\ProductFactory;
use api\product\Product;
use api\model\ValidateInput;

// required headers
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type, origin, *");
header("Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS, DELETE, PATCH");

$method = $_SERVER['REQUEST_METHOD'];
switch($method) {
    case "POST":
        try {
        $path = explode('/', $_SERVER['REQUEST_URI']);
        $productInfo = file_get_contents('php://input');
        $productObj = json_decode(($productInfo));
        if(isset($path[4]) && is_string($path[4]) && $path[4] === 'save') {
            if (!isset($productObj->type)) {
                throw new Exception('Please Select a product type');
            }
            $type = ucfirst(strtolower($productObj->type));
            $productData = Validate($type, $productObj);
             $isValid = ValidateInput::validate($productData);
            $createdProduct = $isValid ? ProductFactory::createProduct($productData) : '';
            $data = $createdProduct ? $createdProduct->getProduct() : '';
            $createdProduct && $createdProduct->save($data);
        } else if(isset($path[4]) && is_string($path[4]) && $path[4] === 'mass-delete') {
            $productInfo = file_get_contents('php://input');
            $productObj = json_decode(($productInfo));
            Product::deleteMassProducts($productObj);
        }
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