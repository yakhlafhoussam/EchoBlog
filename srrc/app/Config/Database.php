<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private $servername = 'mysql_db';
    private $username = 'user';
    private $password = 'houssam.123.321';
    private $dbname = 'echoblog';

    public function connect()
    {
        try {
            $_SESSION['systeme'] = 'up';
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            $_SESSION['systeme'] = 'down';
            $controllerClass = "App\\Controllers\\WrongController";
            $controller = new $controllerClass();
            $controller->index();
            exit();
        }
    }
}