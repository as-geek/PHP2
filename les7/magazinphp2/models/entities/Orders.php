<?php


namespace app\models\entities;


use app\models\Model;

class Orders extends Model
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
}