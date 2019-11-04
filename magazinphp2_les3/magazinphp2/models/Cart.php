<?php


namespace app\models;


class Cart extends Model
{
    public $id;
    public $orderId;
    public $userId;
    public $productId;
    public $count;

    public function __construct($orderId, $userId, $productId, $count)
    {
        parent::__construct();
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->count = $count;
    }

    public function getTableName()
    {
        return "cart";
    }
}