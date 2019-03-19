<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 27.02.19
 * Time: 18:57
 */

class DatabaseConnector
{
    private $hostName;
    private $userName;
    private $password;
    private $dbName;
    private $conn;

    public function dbConnect() {
        $this->hostName='localhost';
        $this->userName='mati';
        $this->password='mati';
        $this->dbName='service';

        try {
            $this->conn = new PDO('mysql:host=' . $this->hostName . ';dbname=' . $this->dbName, $this->userName, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: ".$e->getMessage();
        }
    }

    public function dbDisconnect() {
        $this->conn = NULL;
    }
}