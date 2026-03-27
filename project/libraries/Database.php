<?php

class Database {

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "fitforfun";

    private $dbh;
    private $stmt;

    public function __construct()
    {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;

        $this->dbh = new PDO($dsn,$this->user,$this->pass);
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param,$value)
    {
        $this->stmt->bindValue($param,$value);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
}