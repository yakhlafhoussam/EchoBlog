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
    public function addCategory()
    {
        $title = $_SESSION['title'] = $_POST['title'];
        $icon = $_SESSION['icon'] = $_POST['icon'];
        $color = $_SESSION['color'] = $_POST['color'];
        if (empty($title) || empty($icon) || $icon == "#000000" || $icon == "#ffffff" || empty($color)) {
            $errormsg = 'Please fill in all fields';
            $_SESSION['errormsg'] = $errormsg;
            header('location: /categories');
            return;
        } else {
            $admin = new Admin();
            $admin->addCategory($title, $icon, $color);
            unset($_SESSION['title']);
            unset($_SESSION['icon']);
            unset($_SESSION['color']);
            return;
        }
    }
    public function delCategory()
    {
        $id = $_POST['categorydel'];
        $admin = new Admin();
        $admin->delCategory($id);
    }
}
