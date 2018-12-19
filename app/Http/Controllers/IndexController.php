<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $greeting = 'Hello';
        $name = '';

        return view('index', compact('greeting', 'name'));
    }
}
