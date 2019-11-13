<?php


namespace app\models;


class Users extends DbModel
{
    public $login;
    public $password;
    public $name;
    public $is_admin;

    public function __construct($id = null, $login = null, $password = null, $name = null, $is_admin = null)
    {
        parent::__construct($id);
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->is_admin = $is_admin;
    }


    public static function getTableName() {
        return "users";
    }
}