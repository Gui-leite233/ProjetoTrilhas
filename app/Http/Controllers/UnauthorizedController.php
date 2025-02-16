<?php

namespace App\Http\Controllers;

class UnauthorizedController extends Controller
{
    public function __invoke()
    {
        return view('unauthorized');
    }
}
