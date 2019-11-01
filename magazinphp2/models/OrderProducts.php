<?php


namespace app\models;


class OrderProducts extends Model
{
    public $id;
    public $orderId;
    public $userId;
    public $productId;
    public $count;

    public function getTableName()
    {
        return "order_products";
    }
}