<?php

require_once __DIR__ . '/../bootstrap/autoload.php';

use App\Core\Router;
use App\Config\Database;
use App\Models\User;

session_start();

if (isset($_SESSION['id'])) {
    $update = new User();
    $update->update($_SESSION['id']);
}

$database = new Database();
$database->connect();

$router = new Router();
$router->get('/', 'HomeController@index');
$router->post('/', 'HomeController@newuser');
$router->get('/users', 'UsersController@index');
$router->post('/users', 'UsersController@request');
$router->get('/categories', 'CategoriesController@index');
$router->dispatch();