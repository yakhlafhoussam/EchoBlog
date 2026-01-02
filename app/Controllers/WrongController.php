<?php

namespace App\Controllers;

use App\Core\Controller;

class WrongController extends Controller {
    public function index() {
        $this->view('wrong');
    }
}