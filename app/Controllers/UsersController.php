<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Admin;

class UsersController extends Controller
{

    public function index()
    {
        $admin = new Admin();
        $admin->getAllUsers();
        $this->view('users');
    }
    public function request() {
        if (isset($_POST['accept'])) {
            $admin = new Admin();
            $admin->acceptUsers($_POST['accepted']);
            header('location: /users');
        } elseif (isset($_POST['refuse'])) {
            $admin = new Admin();
            $admin->refuse($_POST['refused']);
            header('location: /users');
        }
    }
}
