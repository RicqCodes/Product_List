<?php

namespace api\product;

use api\database\Database;
use Exception;
use PDO;

class ProductFactory {
    protected $prince = 'data';
    public static function createProduct(array $productData) {
        $data = $productData;

        // Check if SKU is unique
        if(!self::isSkuUnique($productData['sku'])) {
            try {
                throw new Exception('SKU already exists');
            }catch(Exception $e) {
                $response = ['status' => 0, 'message' => $e->getMessage()];
                 echo json_encode($response);
            };
            return null;
        } else {
            // Create a new product based on the type
            return new $productData['type']($data);     
        }
    }

    public static function isSkuUnique(string $sku): bool {

        // Prepare the SQL query to check if the SKU already exists
        $dbConn = new Database();
        $db = $dbConn->getDB();

        $stmt = $db->prepare("SELECT id FROM product WHERE sku = :sku LIMIT 1");
        $stmt->bindParam(":sku", $sku, PDO::PARAM_STR);
        $stmt->execute();

        // If a row is returned, the SKU already exists
        return $stmt->rowCount() === 0;
    }
}
