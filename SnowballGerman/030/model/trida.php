<?php

class trida
{

    const HOST = 'localhost';
    const USER = 'root';
    const PASS = '';
    const DBNAME = 'sb_german';

    protected $conn;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=' . trida::HOST . ';dbname=' . trida::DBNAME,
        trida::USER,
        trida::PASS);
        $this->conn->query('SET NAMES utf8');
    }

    public function exec($sql, $PARAMS = [])
    {
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute($PARAMS);
        if ($result === false) {
            var_dump($stmt->errorInfo());
        }
        return $stmt;
    }

    public function selectAll($sql, $PARAMS = [])
    {
        return $this->exec($sql, $PARAMS)->fetchAll();
    }

    public function selectOne($sql, $PARAMS = [])
    {
        return $this->exec($sql, $PARAMS)->fetch();
    }

    public function insert($sql, $PARAMS = [])
    {
        return $this->exec($sql, $PARAMS);
    }

    public function insertID($sql, $PARAMS = [])
    {
        $this->exec($sql, $PARAMS);
        return $this->conn->lastInsertId();
    }

    public function delete($sql, $params)
    {
        return $this->exec($sql,$params);
    }

    public function update($sql, $params)
    {
        return $this->exec($sql,$params);
    }
}