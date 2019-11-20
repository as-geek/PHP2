<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Users;

class UsersRepository extends Repository
{
    public function isAuth() {
        if (isset($_COOKIE["hash"])) {
            $hash = $_COOKIE["hash"];
            $user = static::getWhereOne('hash', $hash); //todo
            if (!empty($user)) {
                $_SESSION['login'] = $user->login;
            }
        }
        return isset($_SESSION['login']) ? true: false;
    }

    public function getName() {
        return $_SESSION['login'];
    }

    public function auth($login, $password) {
        $user = static::getWhereOne('login', $login);
        if (password_verify($password, $user->password)) {
            $_SESSION['login'] = $login;
            return true;
        }
    }

    public function getTableName() {
        return "users";
    }

    public function getEntityClass() {
        return Users::class;
    }
}
