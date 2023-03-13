<?php

namespace api\model;
use FFI\Exception;


class ValidateInput {

    public static function validate ($productData): bool {
 
     $sku = $productData['sku'];
     $name = $productData['name'];
     $price = $productData['price'];
     $type = $productData['type'];
     
     $weight = isset($productData['properties']['weight']) ? json_decode($productData['properties']['weight']) : null;
     $size = isset($productData['properties']['size']) ? json_decode($productData['properties']['size']) : null;
     $length = isset($productData['properties']['length']) ? json_decode($productData['properties']['length']) : null;
     $width = isset($productData['properties']['width']) ? json_decode($productData['properties']['width']) : null;
     $height = isset($productData['properties']['height']) ? json_decode($productData['properties']['height']) : null;
 
     // Validate input
     if (strlen($sku) < 3 || strlen($sku) > 32) {
         throw new Exception('SKU value must be between 3 and 32');
     }
     if (strlen($name) < 3 || strlen($name) > 255) {
         throw new Exception('Product name must be between 3 and 255');
     }
     if (!is_numeric($price)) {
         throw new Exception('Price must be an integer');
     }
 
     // Check required fields based on product type
     if ($type === 'Book' && (empty($weight) || !is_numeric($weight))) {
         throw new Exception('Weight must be a non-empty integer for books');
     }

     if ($type === 'Dvd' && (empty($size) || !is_numeric($size))) {
         throw new Exception('size must be a non-empty integer for DVDs');
     }
 
     if ($type === 'Furniture') {
         if (empty($length) || !is_numeric($length)) {
             throw new Exception('Length must be a non-empty integer for furniture');
         }
         if (empty($width) || !is_numeric($width)) {
             throw new Exception('Width must be a non-empty integer for furniture');
         }
         if (empty($height) || !is_numeric($height)) {
             throw new Exception('Height must be a non-empty integer for furniture');
         }
     }
 
     return true;
    }
 }
 