<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'db_config.php';

class Connection
{
    private $host = DB_SERVER;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private $db =  DB_DATABASE;

    public function __construct(){
    }

    public function connection(){
        $conn = new mysqli($this->host, $this->user, $this->pass,$this->db);
        if(!$conn){
            die("Network Issue: ". $conn->connect_error);
        }
        return $conn;
    }
}