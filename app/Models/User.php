<?php

namespace App\Models;

use App\Config\Database;
use PDO;

abstract class User
{
    private $first;
    private $last;
    private $email;
    private $role;

    public function __construct()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->first = $user['firstName'];
        $this->last = $user['lastName'];
        $this->email = $user['email'];
        $this->role = $user['role'];
    }
    public function __get($info)
    {
        return $this->$info;
    }
}
