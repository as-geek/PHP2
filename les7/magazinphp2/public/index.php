<?php
session_start();
use app\engine\{Autoload, Render, Request};

include realpath("../config/config.php");
include realpath("../engine/Autoload.php");
include realpath("../vendor/autoload.php");

spl_autoload_register([new Autoload(), 'loadClass']);

$request = new Request();


$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();
$actionId = $request->getActionId();

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName, $actionId);
} else {
    echo "Ошибка: нет такого класса";
}
