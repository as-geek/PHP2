<?php


namespace app\models;


use app\interfaces\IModels;

abstract class Model implements IModels
{
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }
    /*
    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->props[$name] = true;
        $this->$name = $value;
    }
    */
}