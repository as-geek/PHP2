<?php


namespace app\models;


use app\engine\Db;

abstract class DbModel extends Model
{
    public function __get($name)
    {
        return $this->$name;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }

    public function __set($name, $value)
    {
        $this->props[$name] = $value;
    }

    public function getLimit($from, $to) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT :from, :to";
        return Db::getInstance()->queryLimit($sql, $from, $to);
    }

    public function getWhereOne($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE $field = :value";
        return Db::getInstance()->queryObject($sql, ['value' => $value], static::class);
    }

    public static function getCountWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT count(*) as count FROM {$tableName} WHERE $field = :value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }

    public function insert() {
        $tableName = static::getTableName();
        foreach ($this as $key => $value) {
            foreach ($this->props as $keyProp => $prop) {
                if ($key === $keyProp) {
                    $params[":$key"] = $value;
                    $keys[] = $key;
                };
            }
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
        $tableName = static::getTableName();
        foreach ($this as $key => $value) {
            foreach ($this->props as $keyProp => $prop) {
                if ($key === $keyProp AND $prop !== false) {
                    $params[":$key"] = $prop;
                    $keys[] = $key . "=:" . $key;
                };
            }
        }
        $params[":$key"] = $this->id;
        $keys = implode(', ', $keys);

        $sql = "UPDATE {$tableName} SET {$keys} WHERE id = :id";
        Db::getInstance()->execute($sql, $params);

        foreach ($this->props as $keyProp => $prop) {
            $this->props[$keyProp] = false;
        }
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