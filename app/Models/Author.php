<?php

namespace App\Models;

use App\Models\User;
use App\Config\Database;

class Author extends User
{
    public function addArticle($title, $content, $cat) {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("INSERT INTO articles (title, content, author_id, category_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $_SESSION['id'], $cat]);
        $_SESSION['successmsg'] = 'The article has added successfully!';
        header('location: /article');
    }
    public function delArticle($id) {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['successmsg'] = 'The article has deleted successfully!';
        header('location: /article');
    }
}
