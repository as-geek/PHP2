<?php

use app\models\{Product, Users, Orders, Cart};
use app\engine\Autoload;

include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Product("Пицца", 125, 'pizza.jpg');
$product->insert();

//var_dump($product->getOne(2));
//var_dump($product);
//$user = new Users();
//var_dump($user->getAll());
//$orders = new Orders();
//var_dump($orders->getAll());
//$cart = new Cart();
//var_dump($cart->getAll());
