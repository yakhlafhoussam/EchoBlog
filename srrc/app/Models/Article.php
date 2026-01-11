<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Article
{
    public function getAllArticle()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM articles");
        $stmt->execute();
        $article = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['article'] = $article;
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin' && count($article) > 0) {
            $stmt = $conn->prepare("SELECT category_id, COUNT(*) AS total FROM articles GROUP BY category_id ORDER BY total DESC LIMIT 1");
            $stmt->execute();
            $article = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
            $stmt->execute([$article['category_id']]);
            $_SESSION['mostcat'] = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $conn->prepare("SELECT category_id, COUNT(*) AS total FROM articles GROUP BY category_id ORDER BY total ASC LIMIT 1");
            $stmt->execute();
            $article = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
            $stmt->execute([$article['category_id']]);
            $_SESSION['leastcat'] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getMyArticle()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT a.id, a.title, a.content, a.created_at, u.firstName, u.lastName, u.email, c.name, c.icon, c.color, (SELECT COUNT(*) FROM likes WHERE article_id = a.id) AS likes_count, (SELECT COUNT(*) FROM comments WHERE article_id = a.id) AS comments_count FROM articles a JOIN users u ON a.author_id = u.id JOIN categories c ON a.category_id = c.id WHERE a.author_id = ?");
        $stmt->execute([$_SESSION['id']]);
        $article = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['article'] = $article;
    }
    public function getOneBlog($id)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT a.id, a.title, a.content, a.created_at, u.firstName, u.lastName, u.email, c.name, c.icon, c.color, (SELECT COUNT(*) FROM likes WHERE article_id = a.id) AS likes_count, (SELECT COUNT(*) FROM comments WHERE article_id = a.id) AS comments_count FROM articles a JOIN users u ON a.author_id = u.id JOIN categories c ON a.category_id = c.id WHERE a.id = ?");
        $stmt->execute([$id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['oneblog'] = $article;
    }
    public function getAllBlog()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT a.id, a.title, a.content, a.created_at, u.firstName, u.lastName, u.email, c.name, c.icon, c.color, (SELECT COUNT(*) FROM likes WHERE article_id = a.id) AS likes_count, (SELECT COUNT(*) FROM comments WHERE article_id = a.id) AS comments_count FROM articles a JOIN users u ON a.author_id = u.id JOIN categories c ON a.category_id = c.id");
        $stmt->execute();
        $blog = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['blog'] = $blog;
    }
}
