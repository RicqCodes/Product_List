<?php

class Validation {
    private $type;
    private $productData;

    public function __construct($type, $productData) {
        $this->type = $type;
        $this->productData = $productData;
    }

    public function validate(): array {
        $this->checkRequiredFields();
        $this->sanitizeInput();

        switch ($this->type) {
            case 'Book':
                return $this->validateBook();
            case 'Dvd':
                return $this->validateDvd();
            case 'Furniture':
                return $this->validateFurniture();
            default:
                return [];
        }
    }

    private function checkRequiredFields() {
        if (!isset($this->productData->sku) || !isset($this->productData->name) 
            || !isset($this->productData->price) || !isset($this->productData->type)) {
                throw new Exception('All form data must be filled');
        }
    }

    private function sanitizeInput() {
        $this->productData->sku = filter_var($this->productData->sku, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->productData->name = filter_var($this->productData->name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->productData->price = filter_var($this->productData->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $this->productData->type = filter_var($this->productData->type, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    private function validateBook(): array {
        $weight = isset($this->productData->properties->weight) ? filter_var($this->productData->properties->weight, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null;
        if (!isset($weight)) {
            throw new Exception('Please input weight');
        }

        return [
            'sku' => $this->productData->sku,
            'name' => $this->productData->name,
            'price' => $this->productData->price,
            'type' => $this->productData->type,
            'properties' => [
                'weight' => $weight,
            ]
        ];
    }

    private function validateDvd(): array {
        $size = isset($this->productData->properties->size);
        if (!isset($size)) {
            throw new Exception('Please input size');
        }

        return [
            'sku' => $this->productData->sku,
            'name' => $this->productData->name,
            'price' => $this->productData->price,
            'type' => $this->productData->type,
            'properties' => [
                'size' => $size,
            ]
        ];
    }

    private function validateFurniture(): array {
        $width = isset($this->productData->properties->width) ? filter_var(json_decode($this->productData->properties->width), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null;
        $length = isset($this->productData->properties->length) ? filter_var(json_decode($this->productData->properties->length), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null;
        $height = isset($this->productData->properties->height) ? filter_var(json_decode($this->productData->properties->height), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null;

        if (!isset($width) && !isset($length) && !isset($height)) {
            throw new Exception('All Dimension fields must be filled');
        }

        return [
            'sku' => $this->productData->sku,
            'name' => $this->productData->name,
            'price' => $this->productData->name,
            'type' => $this->productData->type,
            'properties' => [
                'width' => $width,
                'length' => $length,
                'height' => $height
            ]
            ];

    }

}