<?php


function Validate($type, $productData): array {
   
    if($type === 'Book') {

        if(!isset($productData->properties->weight)) {
            throw new Exception('Please input weight');
        }

        $bookWeight = json_decode($productData->properties->weight);

        if (!isset($productData->sku) || !isset($productData->name) 
        || !isset($productData->price) || !isset($productData->type) || !isset($bookWeight)) {
            throw new Exception('All form data must be filled');
        }
        
       
    
        // Sanitize input
        $sku = filter_var($productData->sku, FILTER_SANITIZE_STRING);
        $name = filter_var($productData->name, FILTER_SANITIZE_STRING);
        $price = filter_var($productData->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $type = filter_var($productData->type, FILTER_SANITIZE_STRING);
        $weight = filter_var($bookWeight, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
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
        if (!is_numeric($weight)) {
            throw new Exception('weight must be an integer');
        }
    
       
        
        return [
           'sku' => $sku,
           'name' => $name,
           'price' => $price,
           'type' => $type,
           'properties' => [
            'weight' => $weight,
           ]
        ];
    }
    elseif($type === 'Dvd') {
        if(!isset($productData->properties->size)) {
            throw new Exception('Please input size');
        }
        $dvdSize = json_decode($productData->properties->size);

        if (!isset($productData->sku) || !isset($productData->name) 
        || !isset($productData->price) || !isset($productData->type) || !isset($dvdSize)) {
                throw new Exception('All form data must be filled');
            }
        
            // Sanitize input
            $sku = filter_var($productData->sku, FILTER_SANITIZE_STRING);
            $name = filter_var($productData->name, FILTER_SANITIZE_STRING);
            $price = filter_var($productData->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $type = filter_var($productData->type, FILTER_SANITIZE_STRING);
            $size = filter_var($dvdSize, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        
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
            if (!is_numeric($size)) {
                throw new Exception('weight must be an integer');
            }
        
            return [
               'sku' => $sku,
               'name' => $name,
               'price' => $price,
               'type' => $type,
               'properties' => [
                'size' => $size,
               ]
         
            ];
    }
    elseif($type === 'Furniture') {
        if (!isset($productData->properties->length) && !isset($productData->properties->width) && !isset($productData->properties->height)) {
            throw new Exception('Please input description for the furniture product');
        }
        else if (!isset($productData->properties->height)) {
            throw new Exception("Please input height");
        } 
        else if (!isset($productData->properties->width)) {
            throw new Exception("Please input width");
        } 
        else if (!isset($productData->properties->length)) {
            throw new Exception("Please input length");
        } 

        $furnitureLength = json_decode($productData->properties->length);
        $furnitureWidth = json_decode($productData->properties->width);
        $furnitureHeight = json_decode($productData->properties->height);

            if (!isset($productData->sku) || !isset($productData->name) || !isset($productData->price) || !isset($productData->type) 
            || !isset($furnitureWidth) || !isset($furnitureLength) || !isset($furnitureHeight)) {
                throw new Exception('All form data must be filled');
            }
    
        
            // Sanitize input
            $sku = filter_var($productData->sku, FILTER_SANITIZE_STRING);
            $name = filter_var($productData->name, FILTER_SANITIZE_STRING);
            $price = filter_var($productData->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $type = filter_var($productData->type, FILTER_SANITIZE_STRING);
            $width = filter_var($furnitureWidth, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $length = filter_var($furnitureLength, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $height = filter_var($furnitureHeight, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
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
            if (!is_numeric($width)) {
                throw new Exception('width must be an integer');
            }
            if (!is_numeric($length)) {
                throw new Exception('length must be an integer');
            }
            if (!is_numeric($height)) {
                throw new Exception('height must be an integer');
            }
        
            return [
               'sku' => $sku,
               'name' => $name,
               'price' => $price,
               'type' => $type,
               'properties' => [
                'width' => $width,
                'length' => $length,
                'height' => $height,
               ]
         
            ];
    } else {
        return [];
    }
}
