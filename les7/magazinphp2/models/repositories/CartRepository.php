<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Cart;
use app\engine\Db;

class CartRepository extends Repository
{
    public static function getCart($session) {
        $sql = "SELECT p.id id_prod, c.id id_cart, p.name, p.link, p.price FROM cart c,products p WHERE c.product_id=p.id AND session_id = :session";
        return Db::getInstance()->queryAll($sql, ['session' => $session]);
    }

    public function getTableName()
    {
        return "cart";
    }

    public function getEntityClass() {
        return Cart::class;
    }
}