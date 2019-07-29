<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JokeController extends Controller
{
    public function index(Request $request)
    {
        return view('joke.index');
    }
}
