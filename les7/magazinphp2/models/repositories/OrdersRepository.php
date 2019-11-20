<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Orders;

class OrdersRepository extends Repository
{
    public function getTableName()
    {
        return "orders";
    }

    public function getEntityClass() {
        return Orders::class;
    }
}