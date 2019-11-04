<?php


namespace app\models;


class Product extends Model
{
    public $id;
    public $name;
    public $price;
    public $link;

    public function getTableName() {
        return "products";
    }
}
