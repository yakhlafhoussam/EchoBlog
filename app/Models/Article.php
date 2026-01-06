<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Article extends User
{
    public function getAllArticle() {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM articles");
        $stmt->execute();
        $article = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['article'] = $article;
    }
}
