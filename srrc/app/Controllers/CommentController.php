<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Reader;
use App\Models\Author;
use App\Models\Admin;
use App\Models\Article;
use App\Models\Comment;
use Dom\Comment as DomComment;

class CommentController extends Controller
{
    public function index()
    {
        $_SESSION['displaycom'] = $_GET['comment'];
        $blog = new Article();
        $blog->getOneBlog($_SESSION['displaycom']);
        $blog = new Comment();
        $blog->getAllComment($_SESSION['displaycom']);
        if (!isset($_SESSION['id'])) {
            $this->view('404');
        } else {
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
            $this->view('comment', $data);
        }
    }
    public function sendcomment()
    {
        $reader = new Comment();
        $reader->addComment($_POST['pushcomment']);
    }
}
