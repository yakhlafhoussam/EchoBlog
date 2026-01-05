<?php

namespace App\Models;

use App\Models\User;
use App\Config\Database;
use PDO;

class Admin extends User
{
    public function getAllUsers() {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $user = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['users'] = $user;
    }
    public function acceptUsers($id) {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("UPDATE users SET situation = 'no' WHERE id = ?");
        $stmt->execute([$id]);
        $stmt = $conn->prepare("UPDATE users SET role = 'author' WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['successmsg'] = 'The request has successfully accepted!';
    }
    public function refuse($id) {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("UPDATE users SET situation = 'no' WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['successmsg'] = 'The request has successfully refused!';
    }
    public function addCategory($title, $icon, $color) {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("INSERT INTO categories (name, icon, color) VALUES (?, ?, ?)");
        $stmt->execute([$title, $icon, $color]);
        $_SESSION['successmsg'] = 'The category has added successfully!';
        header('location: /categories');
    }
}
