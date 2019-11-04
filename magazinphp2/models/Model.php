<?php


namespace app\models;


use app\interfaces\IModels;

abstract class Model implements IModels
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
        return $this->db->queryOne($sql);
    }
    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
    }
    abstract public function getTableName();
}