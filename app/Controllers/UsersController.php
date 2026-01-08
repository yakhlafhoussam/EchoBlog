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
    public function accept()
    {
        $admin = new Admin();
        $admin->acceptUsers($_POST['accepted']);
        unset($_SESSION['request']);
        $admin->getAllRequest();
        header('location: /users');
    }
    public function refuse()
    {
        $admin = new Admin();
        $admin->refuse($_POST['refused']);
        unset($_SESSION['request']);
        $admin->getAllRequest();
        header('location: /users');
    }
}
