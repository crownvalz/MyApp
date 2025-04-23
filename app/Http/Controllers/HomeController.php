<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Display all leave requests
    public function index()
    {

        return view('dashboard'); // Not home.index anymore
    }
}