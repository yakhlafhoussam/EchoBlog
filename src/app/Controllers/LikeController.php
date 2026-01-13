<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\Database;
use PDO;

class LikeController extends Controller
{
    public function index()
    {
        $test = new Database();
        $conn = $test->connect();
        $stmt = $conn->prepare('SELECT * FROM likes WHERE article_id = ? AND reader_id = ?');
        $stmt->execute([$_POST['article_id'], $_SESSION['id']]);
        if ($stmt->fetch(PDO::FETCH_ASSOC) > 0) {
            $stmt = $conn->prepare('DELETE FROM likes WHERE article_id = ? AND reader_id = ?');
            $stmt->execute([$_POST['article_id'], $_SESSION['id']]);
            echo 0;
        } else {
            $stmt = $conn->prepare('INSERT INTO likes (article_id, reader_id) VALUES (?, ?)');
            $stmt->execute([$_POST['article_id'], $_SESSION['id']]);
            echo 1;
        }
    }
}
