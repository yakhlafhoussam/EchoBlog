<?php

namespace App\Controllers;

use App\Config\Database;
use PDO;

class AuthController
{
    public static function signup($first, $last, $email, $password, $passwordCheck)
    {
        if (empty($first) || empty($last) || empty($email) || empty($password) || empty($passwordCheck)) {
            $errormsg = 'Please fill in all fields';
            $_SESSION['errormsg'] = $errormsg;
            return false;
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errormsg = 'Invalid email';
            $_SESSION['errormsg'] = $errormsg;
            return false;
            exit();
        } elseif ($password != $passwordCheck) {
            $errormsg = 'Please check your password !';
            $_SESSION['errormsg'] = $errormsg;
            return false;
            exit();
        } elseif (!isset($_POST['policy'])) {
            $errormsg = 'You need to accept the Terms & Conditions and Privacy Policy !';
            $_SESSION['errormsg'] = $errormsg;
            return false;
            exit();
        } else {
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
                unset($_SESSION['first']);
                unset($_SESSION['last']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['passwordCheck']);
                return true;
            }
        }
    }
    public static function signin($email, $password)
    {
        if (empty($email) || empty($password)) {
            $errormsg = 'Please fill in all fields';
            $_SESSION['errormsg'] = $errormsg;
            return false;
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errormsg = 'Invalid email';
            $_SESSION['errormsg'] = $errormsg;
            return false;
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
                return true;
            } else {
                $errormsg = 'Incorrect email or password';
                $_SESSION['errormsg'] = $errormsg;
                return false;
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
}
