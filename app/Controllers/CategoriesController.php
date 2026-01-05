<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;

class CategoriesController extends Controller
{
    public function index()
    {
        $this->view('categories');
    }
    public function category() {
        if (isset($_POST['newcategory'])) {
            $title = $_SESSION['title'] = $_POST['title'];
            $icon = $_SESSION['icon'] = $_POST['icon'];
            $color = $_SESSION['color'] = $_POST['color'];
            $this->addNewCategory($title, $icon, $color);
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
}
