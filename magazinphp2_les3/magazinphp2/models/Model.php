<?php


namespace app\models;


use app\interfaces\IModels;
use app\engine\Db;

abstract class Model implements IModels
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function insert() {
        $tableName = $this->getTableName();
        foreach ($this as $key => $value) {
            if ($key === 'db' OR $key === 'id') {
                continue;
            }
            $keys[] = $key;
            $values[] = "'{$value}'";
        }
        $keys = implode(', ', $keys);
        $values = implode(', ', $values);
        $sql = "INSERT INTO {$tableName} ({$keys}) VALUES ({$values})";

        $insert = $this->db->queryAll($sql);

        return var_dump($this->db->lastId());
    }

//    public function delete() {
//
//    }
//
//    public function update() {
//
//    }

    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryOne($sql, ['id' => $id]);
    }
    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
    }
    abstract public function getTableName();
}