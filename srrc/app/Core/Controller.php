<?php

namespace App\Core;

class Controller {

    protected function view($view, $data = []) {
        extract($data);

        $viewFile = __DIR__ . '/../Views/pages/' . $view . '.php';
        $notFound = $viewFile;
        if (!file_exists($viewFile)) {
            $viewFile = __DIR__ . '/../Views/pages/404.php';
        }
        $layoutFile = __DIR__ . '/../Views/layout/layout.php';

        include $layoutFile;
    }
}