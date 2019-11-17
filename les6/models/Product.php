<?php


namespace app\models;


class Product extends DbModel
{
    protected $name;
    protected $price;
    protected $link;

    protected $props = [
        'name' => false,
        'price' => false,
        'link' => false
    ];

    public function __construct($id = null, $name = null, $price = null, $link = null)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->price = $price;
        $this->link = $link;
    }


    public static function getTableName() {
        return "products";
    }
}
