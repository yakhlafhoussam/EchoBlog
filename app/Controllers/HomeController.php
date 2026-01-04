<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Reader;

class HomeController extends Controller
{

    public function index()
    {
        if (!isset($_SESSION['reload'])) {
            $_SESSION['newuser'] = 'no';
        } else {
            unset($_SESSION['reload']);
        }
        $this->view('home');
    }

    public function newuser()
    {
        if (isset($_POST['signup'])) {
            $first = $_SESSION['first'] = $_POST['first'];
            $last = $_SESSION['last'] = $_POST['last'];
            $email = $_SESSION['email'] = $_POST['email'];
            $password = $_SESSION['password'] = $_POST['password'];
            $passwordCheck = $_SESSION['passwordCheck'] = $_POST['passwordCheck'];
            $this->signup($first, $last, $email, $password, $passwordCheck);
        } elseif (isset($_POST['signin'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $this->signin($email, $password);
        } elseif (isset($_POST['logout'])) {
            $outUser = new User();
            $outUser->logout();
            header('location: /');
        } elseif (isset($_POST['request'])) {
            $readerRequest = new Reader();
            $readerRequest->request();
            header('location: /');
        } else {
            if (isset($_SESSION['newuser']) && $_SESSION['newuser'] == 'no') {
                $_SESSION['newuser'] = 'yes';
            } else {
                $_SESSION['newuser'] = 'no';
            }
            $_SESSION['reload'] = 'on';
            header('location: /');
        }
    }

    public function signup($first, $last, $email, $password, $passwordCheck)
    {
        if (empty($first) || empty($last) || empty($email) || empty($password) || empty($passwordCheck)) {
            $errormsg = 'Please fill in all fields';
            $_SESSION['errormsg'] = $errormsg;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errormsg = 'Invalid email';
            $_SESSION['errormsg'] = $errormsg;
        } elseif ($password != $passwordCheck) {
            $errormsg = 'Please check your password !';
            $_SESSION['errormsg'] = $errormsg;
        } elseif (!isset($_POST['policy'])) {
            $errormsg = 'You need to accept the Terms & Conditions and Privacy Policy !';
            $_SESSION['errormsg'] = $errormsg;
        } else {
            $newUser = new User();
            $signup = $newUser->signup($first, $last, $email, $password);
            if ($signup) {
                $_SESSION['newuser'] = 'no';
            }
        }
        $_SESSION['reload'] = 'on';
        header('location: /');
    }

    public function signin($email, $password)
    {
        if (empty($email) || empty($password)) {
            $errormsg = 'Please fill in all fields';
            $_SESSION['errormsg'] = $errormsg;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errormsg = 'Invalid email';
            $_SESSION['errormsg'] = $errormsg;
        } else {
            $oldUser = new User();
            $signin = $oldUser->signin($email, $password);
        }
        $_SESSION['reload'] = 'on';
        header('location: /');
    }
}
