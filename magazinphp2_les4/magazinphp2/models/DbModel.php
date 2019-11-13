<?php


namespace app\models;


use app\engine\Db;

abstract class DbModel extends Model
{
    public function insert() {
        $tableName = static::getTableName();
        foreach ($this as $key => $value) {
            if ($key === 'id') continue;

            $params[":$key"] = $value;
            $keys[] = $key;
        }
        $keys = implode(', ', $keys);
        $values = implode(', ', array_keys($params));


        $sql = "INSERT INTO {$tableName} ({$keys}) VALUES ({$values})";

        Db::getInstance()->execute($sql, $params);

        $this->id = Db::getInstance()->lastInsertId();

        return $this;
    }

    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ["id" => $this->id]);
    }

    public function update() {

    }

    public function save() {
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }

    public static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }
    public static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }
    abstract public static function getTableName();
}