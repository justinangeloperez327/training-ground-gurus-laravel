<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        $title = 'Inventory';

        return view('home', [
            'title' => $title,
        ]);
    }
}
