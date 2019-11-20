<?php


namespace app\controllers;


use \app\models\repositories\UsersRepository;

class AuthController extends Controller
{
    public function actionLogin() {
        $login = $this->request->getParams()['login'];
        $password = $this->request->getParams()['password'];
        if (!(new UsersRepository())->auth($login, $password)) {
            Die("Логин или пароль не верный!");
        } else {
            $hash = uniqid(rand(), true);
            $login = $this->request->getParams()['login'];
            $user = (new UsersRepository())->getWhereOne('login', $login);
            if ($login == $user->login) {
                $user->hash = $hash;
                (new UsersRepository())->update($user);
            }
            setcookie("hash", $hash, time() + 3600, "/");
            header('Location: /');
            exit();
        }
    }

    public function actionLogout() {
        session_regenerate_id();
        session_destroy();
        setcookie("hash", "", time() - 3600, "/");
        header('Location: /');
        exit();
    }
}