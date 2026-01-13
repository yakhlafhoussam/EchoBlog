<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Reader;
use App\Models\Author;
use App\Models\Admin;

class NotFoundController extends Controller
{
    public function index()
    {
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
            $this->view('404', $data);
        } else {
            $this->view('404');
        }
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header('location: /');
        exit();
    }
}
