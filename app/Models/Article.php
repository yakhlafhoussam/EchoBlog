<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Article
{
    public function getAllArticle() {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM articles");
        $stmt->execute();
        $article = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['article'] = $article;
    }
    public function getMyArticle() {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM articles WHERE author_id = ?");
        $stmt->execute([$_SESSION['id']]);
        $article = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['article'] = $article;
    }
    public function getAllBlog() {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT a.title, a.content, a.created_at, u.firstName, u.lastName, u.email, c.name, c.icon, c.color, (SELECT COUNT(*) FROM likes WHERE article_id = a.id) AS likes_count, (SELECT COUNT(*) FROM comments WHERE article_id = a.id) AS comments_count FROM articles a JOIN users u ON a.author_id = u.id JOIN categories c ON a.category_id = c.id");
        $stmt->execute();
        $blog = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['blog'] = $blog;
    }
}
