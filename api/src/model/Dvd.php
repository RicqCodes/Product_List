<?php

namespace api\model;

use api\product\Product;
use api\database\Database;

class DVD extends Product {
    protected $size;

    public function __construct($productData) {
        parent::__construct($productData['sku'], $productData['name'], $productData['price'], $productData['type']);
        $this->size = $productData['properties']['size'];
    }

    public function getSize(): float {
        return $this->size;
    }

    public function getProduct(): array {
        return [
           'sku' => $this->sku,
           'name' => $this->name,
           'price' => $this->price,
           'type' => $this->type,
           'properties' => [
            'size' => $this->getSize(),
           ]
        ];
   }

   public function save($productData) {
    //save book to database
    $dbConn = new Database();
    $db = $dbConn->getDB();

    // Prepare statement
    $properties = json_encode($productData['properties']);
    $stmt = $db->prepare("INSERT INTO product (id, sku, name, price, type, properties) VALUES(null, :sku, :name, :price, :type, '$properties' )");
    
    // Bind values
    $stmt->bindParam(':sku', $productData['sku']);
    $stmt->bindParam(':name', $productData['name']);
    $stmt->bindParam(':price', $productData['price']);
    $stmt->bindParam(':type', $productData['type']);

    if($stmt-> execute()) {
        $response = ['status' => 1, 'message' => 'Product sucessfully added'];
    } else {
        $response = ['status' => 0, 'message' => 'Failed to add product'];
    }

    echo json_encode($response);
}

}