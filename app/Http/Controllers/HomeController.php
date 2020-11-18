<?php

namespace App\Http\Controllers;

use App\Models\Manager;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', ['canBeManager' => (Manager::count() == 0)]);
    }
}
