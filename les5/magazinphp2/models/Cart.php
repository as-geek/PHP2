<?php


namespace app\models;


class Cart extends DbModel
{
    public $orderId;
    public $userId;
    public $productId;
    public $count;

    public function __construct($id = null, $orderId = null, $userId = null, $productId = null, $count = null)
    {
        parent::__construct($id);
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->count = $count;
    }

    public static function getTableName()
    {
        return "cart";
    }
}