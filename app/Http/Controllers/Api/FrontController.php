<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function getTechText()
    {
        return [
            'laravel' => 'Laravel 5.7',
            'bootstrap' => 'Bootstrap 4',
            'php' => 'PHP 7.2',
            'js_front' => 'VueJS',
            'js_tech' => 'Node/NPM',
        ];
    }
}
