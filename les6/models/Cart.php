<?php


namespace app\models;


use app\engine\Db;

class Cart extends DbModel
{
    protected $id;
    protected $session_id;
    protected $product_id;

    protected $props = [
        'session_id' => false,
        'product_id' => false
    ];

    public function __construct($session_id = null, $product_id = null)
    {
        $this->session_id = $session_id;
        $this->product_id = $product_id;
    }

    public static function getCart($session) {
        $sql = "SELECT p.id id_prod, c.id id_cart, p.name, p.link, p.price FROM cart c,products p WHERE c.product_id=p.id AND session_id = :session";
        return Db::getInstance()->queryAll($sql, ['session' => $session]);
    }
    public static function getTableName()
    {
        return "cart";
    }
}