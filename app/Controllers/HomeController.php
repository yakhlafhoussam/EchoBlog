<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Reader;
use App\Models\Author;
use App\Models\Admin;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $blog = new Article();
        $blog->getAllBlog();
        if (!isset($_SESSION['reload'])) {
            $_SESSION['newuser'] = 'no';
        } else {
            unset($_SESSION['reload']);
        }
        if (isset($_SESSION['id'])) {
            if ($_SESSION['role'] == 'reader') {
                $reader = new Reader();
                $firstInfo = $reader->first;
                $lastInfo = $reader->last;
                $emailInfo = $reader->email;
            } elseif ($_SESSION['role'] == 'author') {
                $author = new Author();
                $firstInfo = $author->first;
                $lastInfo = $author->last;
                $emailInfo = $author->email;
            } elseif ($_SESSION['role'] == 'admin') {
                $admin = new Admin();
                $firstInfo = $admin->first;
                $lastInfo = $admin->last;
                $emailInfo = $admin->email;
                $admin->getAllRequest();
            }
            $data = [
                'first' => $firstInfo,
                'last' => $lastInfo,
                'email' => $emailInfo,
            ];
            $this->view('home', $data);
        } else {
            $this->view('home');
        }
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
            session_unset();
            session_destroy();
            header('location: /');
            exit();
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
        $newUser = AuthController::signup($first, $last, $email, $password, $passwordCheck);
        if ($newUser) {
            $_SESSION['newuser'] = 'no';
        }
        $_SESSION['reload'] = 'on';
        header('location: /');
    }

    public function signin($email, $password)
    {
        $oldUser = AuthController::signin($email, $password);
        $_SESSION['reload'] = 'on';
        header('location: /');
    }
}
