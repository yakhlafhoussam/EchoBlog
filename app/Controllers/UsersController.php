<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;

class UsersController extends Controller
{

    public function index()
    {
        if (isset($_SESSION['id'])) {
            if ($_SESSION['role'] == 'reader') {
                $this->view('404');
            } elseif ($_SESSION['role'] == 'author') {
                $this->view('404');
            } elseif ($_SESSION['role'] == 'admin') {
                $admin = new Admin();
                $admin->getAllUsers();
                $firstInfo = $admin->first;
                $lastInfo = $admin->last;
                $emailInfo = $admin->email;
                $data = [
                    'first' => $firstInfo,
                    'last' => $lastInfo,
                    'email' => $emailInfo,
                ];
                $this->view('users', $data);
            }
        } else {
            $this->view('404');
        }
    }
    public function request()
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
        } elseif (isset($_POST['accept'])) {
            $admin = new Admin();
            $admin->acceptUsers($_POST['accepted']);
            unset($_SESSION['request']);
            $admin->getAllRequest();
            header('location: /users');
        } elseif (isset($_POST['refuse'])) {
            $admin = new Admin();
            $admin->refuse($_POST['refused']);
            unset($_SESSION['request']);
            $admin->getAllRequest();
            header('location: /users');
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
