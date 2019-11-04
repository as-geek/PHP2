<?php


namespace app\models;


class Users extends Model
{
    public $id;
    public $login;
    public $password;
    public $name;
    public $is_admin;

    public function getTableName() {
        return "users";
    }
}