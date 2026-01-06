<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Category extends User
{
    public function getAllCategory() {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        $category = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['category'] = $category;
    }
}
