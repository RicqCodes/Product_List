<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require('ProductFactory.php');

//Define book class
class Book extends Product {
    protected $weight;
    public function __construct($productData) {
        parent::__construct($productData['sku'], $productData['name'], $productData['price'], $productData['type']);
        $this->weight = $productData['properties']['weight'];
    }

    public function getWeight():float {
        return $this->weight;
    }

    // This is just for test
    public function getProduct(): array {
         return [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'type' => $this->type,
            'properties' => [
             'weight' => $this->getWeight(),
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