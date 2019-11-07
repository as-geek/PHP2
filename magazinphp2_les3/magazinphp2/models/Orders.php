<?php


namespace app\models;


class Orders extends Model
{
    public $orderId;
    public $userId;
    public $name;
    public $phone;
    public $address;

    public function __construct($userId, $name, $phone, $address)
    {
        parent::__construct();
        $this->userId = $userId;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
    }


    public function getTableName()
    {
        return "orders";
    }
}