<?php


namespace app\models;


class Orders extends DbModel
{
    protected $orderId;
    protected $userId;
    protected $name;
    protected $phone;
    protected $address;

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