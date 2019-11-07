<?php


namespace app\models;


class Product extends Model
{
    public $id;
    public $name;
    public $price;
    public $link;

    public function __construct($name, $price, $link)
    {
        parent::__construct();
        $this->name = $name;
        $this->price = $price;
        $this->link = $link;
    }


    public function getTableName() {
        return "products";
    }
}
