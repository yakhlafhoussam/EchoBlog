<?php

namespace App\Models;

use App\Models\User;
use App\Config\Database;

class Reader extends User
{
    public function request() {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("UPDATE users SET situation = 'yes' WHERE id = ?");
        $stmt->execute([$_SESSION['id']]);
        $_SESSION['successmsg'] = 'The request has been sent successfully!';
    }
}
