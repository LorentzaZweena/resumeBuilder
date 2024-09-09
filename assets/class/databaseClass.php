<?php
date_default_timezone_set('Asia/Calcutta');
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'resumebuilder';
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function real_escape_string($string) {
        return $this->conn->real_escape_string($string);
    }

    public function query($query) {
        return $this->conn->query($query);
    }
}
?>
