<?php

namespace api\product;

use api\database\Database;
use PDO;


abstract class Product {
    protected $sku;
    protected $name;
    protected $price;
    protected $type;

    public function __construct(string $sku, string $name, float $price, string $type) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
    }

    public function getSku(): string {
        return $this->sku;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getType(): string {
        return $this->type;
    }

    public abstract function save($productData);

    public static function getAllProducts() {
        // Prepare the SQL query to check if the SKU already exists
        $dbConn = new Database();
        $db = $dbConn->getDB();

        $stmt = $db->prepare("SELECT * FROM product");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
    }

    public static function deleteMassProducts($productSku) {
        // convert the array to string
        $sku_string = "'" . implode("','", $productSku) . "'";
        
        //  Prepare the SQL query to check if the SKU already exists
         $dbConn = new Database();
         $db = $dbConn->getDB();
         $sql = "DELETE FROM product WHERE sku IN ($sku_string)";
         $stmt = $db->prepare($sql);
         if($stmt-> execute()) {
            $response = ['status' => 1, 'message' => 'Product sucessfully deleted'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to delete product'];
        }

        echo json_encode($response);
    }
}
