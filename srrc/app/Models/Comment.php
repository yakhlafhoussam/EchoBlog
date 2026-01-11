<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Comment
{
    public function getAllComment($id)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT u.firstName, u.lastName, u.email, cm.content, cm.created_at FROM comments cm JOIN users u ON cm.reader_id = u.id WHERE article_id = ?");
        $stmt->execute([$id]);
        $article = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['allcomment'] = $article;
    }
    public function addComment($id)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("INSERT INTO comments (content, article_id, reader_id) VALUES (?, ?, ?)");
        $stmt->execute([$id, $_SESSION['displaycom'], $_SESSION['id']]);
        $_SESSION['successmsg'] = 'The comment has added successfully!';
        header('location: /comments?comment=' . $_SESSION['displaycom']);
    }
}
