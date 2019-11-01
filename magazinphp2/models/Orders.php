<?php


namespace app\models;


class Orders extends Model
{
    public $orderId;
    public $userId;
    public $name;
    public $phone;
    public $address;

    public function getTableName()
    {
        return "orders";
    }
}