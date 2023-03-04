<?php

class Product {
    private $sku;
    private $name;
    private $price;

    public function __construct($sku, $name, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public function get_sku() {
        return $this->sku;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_price() {
        return $this->price;
    }
}