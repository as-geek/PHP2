<?php


namespace app\models;


class Orders extends DbModel
{
    public $orderId;
    public $userId;
    public $name;
    public $phone;
    public $address;

    public function __construct($userId = null, $name = null, $phone = null, $address = null)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
    }


    public static function getTableName()
    {
        return "orders";
    }
}