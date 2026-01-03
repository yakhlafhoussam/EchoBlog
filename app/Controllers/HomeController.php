<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\Database;
use PDO;
use PDOException;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home');
        $_SESSION['newuser'] = 'no';
    }
    public function newuser()
    {
        if (isset($_POST['signup'])) {
            $errormsg = '';
            $first = $_POST['first'];
            $last = $_POST['last'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordCeck = $_POST['passwordCeck'];

            if (empty($first) || empty($last) || empty($email) || empty($password) || empty($passwordCeck)) {
                $errormsg = 'Please fill in all fields';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errormsg = 'Invalid email';
            } elseif ($password != $passwordCeck) {
                $errormsg = 'Please check your password !';
            } else {
                $database = new Database();
                $conn = $database->connect();
                $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch(PDO::FETCH_ASSOC) > 0) {
                    $errormsg = 'Email already registered';
                } else {
                    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, role) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$first, $last, $email, password_hash($password, PASSWORD_DEFAULT), 'reader']);
                    $errormsg = 'good';
                    $_SESSION['newuser'] = 'no';
                }
            }
            $_SESSION['msg'] = $errormsg;
        } else {
            if (isset($_SESSION['newuser']) && $_SESSION['newuser'] == 'no') {
                $_SESSION['newuser'] = 'yes';
            } else {
                $_SESSION['newuser'] = 'no';
            }
        }
        $this->view('home');
    }
}
