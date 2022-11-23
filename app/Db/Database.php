<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database
{

    const dbname = "app_db";
    const dbhost = "localhost:3306";
    const use = "r2soft";
    const senha = "r2147258369";

    // const NAME = "app_db";
    // const USER = "r2soft";
    // const SENHA = "R2147258369";

    private $table;

    // @var PDO

    private $connection;


    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }
    private function setConnection()
    {
        try {
            $this->connection = new PDO("mysql:dbname=" . self::dbname . ";host=" . self::dbhost, self::use, self::senha);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erro: ' . $e->getMessage());
        }
    }

    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('Erro: ' . $e->getMessage());
        }
    }



    public function insert($values)
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        $query = 'INSERT INTO  ' . $this->table . ' (' . implode(',', $fields) . ') VALUE (' . implode(',', $binds) . ')';

        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();
    }

    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }

    public function update($where, $values)
    {
        $fields = array_keys($values);
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;
        $this->execute($query, array_values($values));
        return true;
    }
}
