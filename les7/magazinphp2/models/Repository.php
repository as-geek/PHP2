<?php


namespace app\models;


use app\engine\Db;
use app\interfaces\IModels;

abstract class Repository implements IModels
{
    public function getLimit($from, $to) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT :from, :to";
        return Db::getInstance()->queryLimit($sql, $from, $to);
    }

    public function getWhereOne($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE $field = :value";
        return Db::getInstance()->queryObject($sql, ['value' => $value], $this->getEntityClass());
    }

    public function getCountWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT count(*) as count FROM {$tableName} WHERE $field = :value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }

    public function insert(Model $entity) {
        $tableName = static::getTableName();
//        var_dump($entity);
        foreach ($entity as $key => $value) {
            foreach ($entity->props as $keyProp => $prop) {
                if ($key === $keyProp) {
                    $params[":$key"] = $value;
                    $keys[] = $key;
                };
            }
        }

//        var_dump($keys);

        $keys = implode(', ', $keys);
        $values = implode(', ', array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$keys}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);

        $entity->id = Db::getInstance()->lastInsertId();
    }

    public function delete(Model $entity) {
        $tableName = static::getTableName();

        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ["id" => $entity->id]);
    }

    public function update(Model $entity) {
        $tableName = static::getTableName();
//        var_dump($entity->props);
//        die();
        foreach ($entity as $key => $value) {

            foreach ($entity->props as $keyProp => $prop) {
                if ($key === $keyProp AND $prop !== false) {
                    $params[":$key"] = $prop;
                    $keys[] = $key . "=:" . $key;
                };
            }
        }
        $params[":$key"] = $entity->id;
//        var_dump($keys);
//        die();
        $keys = implode(', ', $keys);

        $sql = "UPDATE {$tableName} SET {$keys} WHERE id = :id";
        Db::getInstance()->execute($sql, $params);

        foreach ($entity->props as $keyProp => $prop) {
            $entity->props[$keyProp] = false;
        }
    }

    public function save(Model $entity) {
        if (is_null($entity->id))
            $this->insert($entity);
        else
            $this->update($entity);
    }

    public function getOne($id) {
        $tableName = static::getTableName();

        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll() {
        $tableName = static::getTableName();

        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }
}