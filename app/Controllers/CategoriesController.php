<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Article;

class CategoriesController extends Controller
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
                $admin = new Category();
                $admin->getAllCategory();
                $admin = new Article();
                $admin->getAllArticle();
                $this->view('categories', $data);
            }
        } else {
            $this->view('404');
        }
    }
    public function category() {
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
        } elseif (isset($_POST['newcategory'])) {
            $title = $_SESSION['title'] = $_POST['title'];
            $icon = $_SESSION['icon'] = $_POST['icon'];
            $color = $_SESSION['color'] = $_POST['color'];
            $this->addNewCategory($title, $icon, $color);
        } elseif (isset($_POST['delete'])) {
            $categoryId = $_POST['categorydel'];
            $this->delCategory($categoryId);
        }
    }
    public function addNewCategory($title, $icon, $color) {
        if (empty($title) || empty($icon) || $icon == "#000000" || $icon == "#ffffff" || empty($color)) {
            $errormsg = 'Please fill in all fields';
            $_SESSION['errormsg'] = $errormsg;
            header('location: /categories');
        } else {
            $admin = new Admin();
            $admin->addCategory($title, $icon, $color);
            unset($_SESSION['title']);
            unset($_SESSION['icon']);
            unset($_SESSION['color']);
        }
    }
    public function delCategory($id) {
        $admin = new Admin();
        $admin->delCategory($id);
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
