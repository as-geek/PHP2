<?php

use app\models\{Product, Users, Orders, OrderProducts};
use app\engine\Db;

include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Product(new Db());
$user = new Users(new Db());
$orders = new Orders(new Db());
$orderProducts = new OrderProducts(new Db());

//var_dump($product);