<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['id'])) {
            if ($_SESSION['role'] == 'reader') {
                $this->view('404');
            } elseif ($_SESSION['role'] == 'admin') {
                $this->view('404');
            } elseif ($_SESSION['role'] == 'author') {
                $author = new Author();
                $firstInfo = $author->first;
                $lastInfo = $author->last;
                $emailInfo = $author->email;
                $data = [
                    'first' => $firstInfo,
                    'last' => $lastInfo,
                    'email' => $emailInfo,
                ];
                $author = new Category();
                $author->getAllCategory();
                $author->getMyCategory();
                $author = new Article();
                $author->getMyArticle();
                $this->view('article', $data);
            }
        } else {
            $this->view('404');
        }
    }
    public function addarticle()
    {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $cat = $_POST['categoryone'];
        $this->addNewArticle($title, $content, $cat);
    }
    public function delarticle()
    {
        $id = $_POST['articledell'];
        $this->deleteArticle($id);
    }
    public function addNewArticle($title, $content, $cat)
    {
        $author = new Author();
        $author->addArticle($title, $content, $cat);
    }
    public function deleteArticle($id)
    {
        $author = new Author();
        $author->delArticle($id);
    }
}
