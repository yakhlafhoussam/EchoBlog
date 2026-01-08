<?php

require_once __DIR__ . '/../bootstrap/autoload.php';

use App\Core\Router;
use App\Config\Database;
use App\Controllers\AuthController;

session_start();

if (isset($_SESSION['id'])) {
    $update = AuthController::update($_SESSION['id']);
}

$database = new Database();
$database->connect();

$router = new Router();
$router->get('/', 'HomeController@index');
$router->post('/', 'HomeController@newuser');
$router->post('/signup', 'AuthController@signup');
$router->post('/login', 'AuthController@login'); // edit the signin to login in form action
$router->post('/logout', 'AuthController@logout');
$router->get('/users', 'UsersController@index');
$router->post('/users', 'UsersController@request');
$router->get('/categories', 'CategoriesController@index');
$router->post('/addcategory', 'CategoriesController@addCategory');
$router->post('/delcategory', 'CategoriesController@delCategory');
$router->post('/accept', 'UsersController@accept');
$router->post('/refuse', 'UsersController@refuse');
$router->get('/article', 'ArticleController@index');
$router->post('/article', 'ArticleController@article');
$router->post('/addarticle', 'ArticleController@addarticle');

$router->dispatch();