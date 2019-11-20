<?php


namespace app\models;


class Users extends DbModel
{
    protected $login;
    protected $password;
    protected $name;
    protected $is_admin;
    protected $hash;

    protected $props = [
        'login' => false,
        'password' => false,
        'name' => false,
        'is_admin' => false,
        'hash' => false
    ];

    public function __construct($id = null, $login = null, $password = null,
                                $name = null, $is_admin = null, $hash = null)
    {
        parent::__construct($id);
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->is_admin = $is_admin;
        $this->hash = $hash;
    }

    public static function isAuth() {
        if (isset($_COOKIE["hash"])) {
            $hash = $_COOKIE["hash"];
            $user = Users::getWhereOne('hash', $hash);
            if (!empty($user)) {
                $_SESSION['login'] = $user->login;
            }
        }
        return isset($_SESSION['login']) ? true: false;
    }

    public static function getName() {
        return $_SESSION['login'];
    }

    public static function auth($login, $password) {
        $user = static::getWhereOne('login', $login);
        if (password_verify($password, $user->password)) {
            $_SESSION['login'] = $login;
            return true;
        }
    }

    public static function getTableName() {
        return "users";
    }
}
