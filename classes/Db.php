<?php

// namespace myDb;
require 'connection.php';


class Db
{
    private $_host = HOST;
    private $_username = USER;
    private $_password = PASSWORD;
    private $_dbname = DBNAME;

    private static $instance  = null; // should be static
    private $connection;

    public static function getInstance () {
        if (is_null(self::$instance)) {
            self::$instance = new self (); // new myDb\self () ?????
        }
        return self::$instance;
    }
    //
    private function __construct(){

        $this->connection = new mysqli($this->_host, $this->_username,
            $this->_password, $this->_dbname);


       // Error handling
        if (mysqli_connect_errno()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }
    private function __clone(){
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function mysqli() {
        return $this->connection;
    }
}
/*    $db = Db::getInstance(); //
    $sql = "SELECT * FROM products";
    $q = $db->query($sql); // deleted comments


    while($row = $q->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["title"]. " " . $row["description"]. "<br>";
    }*/