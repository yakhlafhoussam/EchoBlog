<?php

require_once __DIR__ . '/../bootstrap/autoload.php';

use App\Core\Router;
use App\Config\Database;

session_start();
session_unset();
session_destroy();

$database = new Database();
$database->connect();

$router = new Router();
$router->get('/', 'HomeController@index');
$router->dispatch();