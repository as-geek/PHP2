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

}