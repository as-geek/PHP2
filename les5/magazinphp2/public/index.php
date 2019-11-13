<?php

use app\models\{Product, Users, Orders, Cart};
use app\engine\{Autoload, Render, TwigRender};

include realpath("../config/config.php");
include realpath("../engine/Autoload.php");
include realpath("../vendor/autoload.php");

spl_autoload_register([new Autoload(), 'loadClass']);

$url = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = empty($url[1]) ? 'product' : $url[1];
$actionName = $url[2];
$actionId = $url[3];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRender());
    $controller->runAction($actionName, $actionId);
} else {
    echo "Ошибка: нет такого класса";
}


$product = new Product(60,"Пицца", 88, 'pizza.jpg');
$product->save();







/*$product = new Product("Пицца", 125, 'pizza.jpg');
$product->insert();

//$product = Product::getOne(30);
//$product->delete();
//$product->insert();

var_dump($product);
//var_dump($product);
//$user = new Users();
//var_dump($user->getAll());
//$orders = new Orders();
//var_dump($orders->getAll());
//$cart = new Cart();
//var_dump($cart->getAll());
*/