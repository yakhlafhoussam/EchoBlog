<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class User
{
    private $id;
    private $first;
    private $last;
    private $email;
    private $password;
    private $role;

    public function signup($first, $last, $email, $password)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch(PDO::FETCH_ASSOC) > 0) {
            $errormsg = 'Email already registered';
            $_SESSION['errormsg'] = $errormsg;
            return false;
        } else {
            $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$first, $last, $email, password_hash($password, PASSWORD_DEFAULT), 'reader']);
            $errormsg = 'Account created successfully!';
            $_SESSION['successmsg'] = $errormsg;
            return true;
        }
    }
    public function signin($email, $password)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['situation'] = $user['situation'];
            $_SESSION['first'] = $user['firstName'];
            $_SESSION['last'] = $user['lastName'];
            $_SESSION['email'] = $user['email'];
            return true;
        } else {
            $errormsg = 'Incorrect email or password';
            $_SESSION['errormsg'] = $errormsg;
            return false;
        }
    }
    public function logout() {
        session_unset();
        session_destroy();
    }
    public function update($id) {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['role'] = $user['role'];
        $_SESSION['situation'] = $user['situation'];
    }
}
