<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Category
{
    public function getAllCategory()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        $category = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['category'] = $category;
    }
    public function getMyCategory()
    {
        $catid = [];
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM articles WHERE author_id = ?");
        $stmt->execute([$_SESSION['id']]);
        $category = $stmt->fetchALL(PDO::FETCH_ASSOC);
        if (count($category) > 0) {
            for ($i = 0; $i < count($category); $i++) {
                $id = $category[$i]['category_id'];
                if (isset($catid[$id])) {
                    $catid[$id] += 1;
                } else {
                    $catid[$id] = 1;
                }
            }
            $id = array_keys($catid, max($catid));
            $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
            $stmt->execute([$id[0]]);
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['authorcat'] = $category;
        }
    }
}
