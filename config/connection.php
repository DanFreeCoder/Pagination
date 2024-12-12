<?php
class Connection
{


    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'pagination_db';

    protected $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $this->conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
