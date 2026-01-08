<?php

namespace App\Models;

use App\Models\User;
use App\Config\Database;
use PDO;

class Admin extends User
{
    public function getAllUsers()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $user = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['users'] = $user;
    }
    public function getAllRequest()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE situation = 'yes'");
        $stmt->execute();
        $user = $stmt->fetchALL(PDO::FETCH_ASSOC);
        if (count($user) > 0) {
            $_SESSION['request'] = count($user);
        }
    }
    public function acceptUsers($id)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("UPDATE users SET situation = 'no' WHERE id = ?");
        $stmt->execute([$id]);
        $stmt = $conn->prepare("UPDATE users SET role = 'author' WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['successmsg'] = 'The request has successfully accepted!';
    }
    public function refuse($id)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("UPDATE users SET situation = 'no' WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['successmsg'] = 'The request has successfully refused!';
    }
    public function addCategory($title, $icon, $color)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("INSERT INTO categories (name, icon, color) VALUES (?, ?, ?)");
        $stmt->execute([$title, $icon, $color]);
        $_SESSION['successmsg'] = 'The category has added successfully!';
        header('location: /categories');
    }
    public function getAllCategory()
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        $category = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['category'] = $category;
        $stmt = $conn->prepare("SELECT * FROM articles");
        $stmt->execute();
        $category = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['article'] = $category;
    }
    public function delCategory($id)
    {
        try {
            $database = new Database();
            $conn = $database->connect();
            $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['successmsg'] = 'The category has deleted successfully!';
        } catch (\Throwable $th) {
            $_SESSION['errormsg'] = 'This category is used in some article!';
        }
        header('location: /categories');
    }
}
