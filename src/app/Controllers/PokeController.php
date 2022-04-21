<?php

namespace App\Controllers;

use App\Helper;

class PokeController
{
    /**
     * @return string
     */
    public function index(): string
    {
        return file_get_contents(ROOT_PATH . '/views/index.phtml');
    }
}