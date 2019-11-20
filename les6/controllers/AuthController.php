<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Cart;
use app\models\DbModel;
use app\models\Users;
use http\Client\Curl\User;

class AuthController extends Controller
{
    public function actionLogin() {
        $login = $this->request->getParams()['login'];
        $password = $this->request->getParams()['password'];
        if (!Users::auth($login, $password)) {
            Die("Логин или пароль не верный!");
        } else {
            $hash = uniqid(rand(), true);
            $login = $this->request->getParams()['login'];
            $user = Users::getWhereOne('login', $login);
            if ($login == $user->login) {
                $user->hash = $hash;
                $user->update();
            }
            setcookie("hash", $hash, time() + 3600, "/");
            header('Location: /');
            exit();
        }
    }

    public function actionLogout() {
        session_destroy();
        setcookie("hash", "", time() - 3600, "/");
        header('Location: /');
        exit();
    }
}