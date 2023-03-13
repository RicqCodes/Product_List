<?php



function Validate($type, $productData): array {
    if (!isset($productData->sku) || !isset($productData->name) 
        || !isset($productData->price) || !isset($productData->type)) {
            throw new Exception('All form data must be filled');
        }

    // Sanitize input
    $sku = filter_var($productData->sku, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_var($productData->name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($productData->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $Santizedtype = filter_var($productData->type, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   
    if ($type === 'Book') {
        $weight = isset($productData->properties->weight) ? filter_var($productData->properties->weight, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null;
        if (!isset($weight)) {
            throw new Exception('Please input weight');
        }

        return [
           'sku' => $sku,
           'name' => $name,
           'price' => $price,
           'type' => $Santizedtype,
           'properties' => [
            'weight' => $weight,
           ]
        ];
    }
    elseif ($type === 'Dvd') {
        $size = isset($productData->properties->size);
        if (!isset($size)) {
            throw new Exception('Please input size');
        }
            return [
               'sku' => $sku,
               'name' => $name,
               'price' => $price,
               'type' => $Santizedtype,
               'properties' => [
                'size' => $size,
               ]
         
            ];
    }
    elseif($type === 'Furniture') {
        $width = isset($productData->properties->width) ? filter_var(json_decode($productData->properties->width), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null;
        $length = isset($productData->properties->length) ? filter_var(json_decode($productData->properties->length), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null;
        $height = isset($productData->properties->height) ? filter_var(json_decode($productData->properties->height), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null;

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
            return [
               'sku' => $sku,
               'name' => $name,
               'price' => $price,
               'type' => $Santizedtype,
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
