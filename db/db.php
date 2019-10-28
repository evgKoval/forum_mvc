<?php

$host = 'localhost';
$dbname = 'forum_mvc';
$user = 'root';
$password = 'root';

class Db {
    public $host;
    public $dbname;
    public $user;
    public $password;

    public function __construct($host, $dbname, $user=NULL, $password=NULL) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function getConnection() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        $db = new PDO($dsn, $this->user, $this->password);
        $db->exec("set names utf8");

        return $db;
    }
}

$db = new Db($host, $dbname, $user, $password);