<?php


namespace app\models;


class Users extends Model
{
    public $id;
    public $login;
    public $password;
    public $name;
    public $is_admin;

    public function __construct($login, $password, $name, $is_admin)
    {
        parent::__construct();
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->is_admin = $is_admin;
    }


    public function getTableName() {
        return "users";
    }
}