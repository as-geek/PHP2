<?php


namespace app\models;


class Product extends DbModel
{
    public $id;
    public $name;
    public $price;
    public $link;

    public function __construct($name = null, $price = null, $link = null)
    {
        $this->name = $name;
        $this->price = $price;
        $this->link = $link;
    }


    public static function getTableName() {
        return "products";
    }
}
