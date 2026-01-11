<?php

namespace App\Controllers;

use App\Config\Database;
use PDO;

class AuthController
{
    public static function signup()
    {
        $first = $_SESSION['first'] = $_POST['first'];
        $last = $_SESSION['last'] = $_POST['last'];
        $email = $_SESSION['email'] = $_POST['email'];
        $password = $_SESSION['password'] = $_POST['password'];
        $passwordCheck = $_SESSION['passwordCheck'] = $_POST['passwordCheck'];
        if (empty($first) || empty($last) || empty($email) || empty($password) || empty($passwordCheck)) {
            $errormsg = 'Please fill in all fields';
            $_SESSION['errormsg'] = $errormsg;
            $_SESSION['reload'] = 'on';
            header('Location: /');
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errormsg = 'Invalid email';
            $_SESSION['errormsg'] = $errormsg;
            $_SESSION['reload'] = 'on';
            header('Location: /');
            exit();
        } elseif ($password != $passwordCheck) {
            $errormsg = 'Please check your password !';
            $_SESSION['errormsg'] = $errormsg;
            $_SESSION['reload'] = 'on';
            header('Location: /');
            exit();
        } elseif (!isset($_POST['policy'])) {
            $errormsg = 'You need to accept the Terms & Conditions and Privacy Policy !';
            $_SESSION['errormsg'] = $errormsg;
            $_SESSION['reload'] = 'on';
            header('Location: /');
            exit();
        } else {
            $database = new Database();
            $conn = $database->connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch(PDO::FETCH_ASSOC) > 0) {
                $errormsg = 'Email already registered';
                $_SESSION['errormsg'] = $errormsg;
                $_SESSION['reload'] = 'on';
                header('Location: /');
                exit();
            } else {
                $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, role) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$first, $last, $email, password_hash($password, PASSWORD_DEFAULT), 'reader']);
                $errormsg = 'Account created successfully!';
                $_SESSION['successmsg'] = $errormsg;
                unset($_SESSION['first']);
                unset($_SESSION['last']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['passwordCheck']);
                $_SESSION['newuser'] = 'no';
                $_SESSION['reload'] = 'on';
                header('Location: /');
            }
        }
    }
    public static function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email) || empty($password)) {
            $errormsg = 'Please fill in all fields';
            $_SESSION['errormsg'] = $errormsg;
            $_SESSION['reload'] = 'on';
            header('location: /');
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errormsg = 'Invalid email';
            $_SESSION['errormsg'] = $errormsg;
            $_SESSION['reload'] = 'on';
            header('location: /');
            exit();
        } else {
            $database = new Database();
            $conn = $database->connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['situation'] = $user['situation'];
                $_SESSION['reload'] = 'on';
                header('location: /');
                exit();
            } else {
                $errormsg = 'Incorrect email or password';
                $_SESSION['errormsg'] = $errormsg;
                $_SESSION['reload'] = 'on';
                header('location: /');
                exit();
            }
        }
    }
    public static function update($id)
    {
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['role'] = $user['role'];
        $_SESSION['situation'] = $user['situation'];
    }
    public function logout()
    {
        unset($_SESSION);
        session_destroy();
        header('Location: /');
    }
}
