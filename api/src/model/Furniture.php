<?php

namespace api\model;

use api\product\Product;
use api\database\Database;

class Furniture extends Product {
    protected $height;
    protected $width;
    protected $length;

    public function __construct($productData) {
        parent::__construct($productData['sku'], $productData['name'], $productData['price'], $productData['type']);
        $this->height = $productData['properties']['height'];
        $this->width = $productData['properties']['width'];
        $this->length = $productData['properties']['width'];
    }

    public function getHeight(): float {
        return $this->height;
    }

    public function getWidth(): float {
        return $this->width;
    }

    public function getLength(): float {
        return $this->length;
    }

    public function getProduct(): array {
        return [
           'sku' => $this->sku,
           'name' => $this->name,
           'price' => $this->price,
           'type' => $this->type,
           'properties' => [
            'height' => $this->getHeight(),
            'width' => $this->getWidth(),
            'length' => $this->getLength(),
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