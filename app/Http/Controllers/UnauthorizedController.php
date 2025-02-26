<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnauthorizedController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('unauthorized', [
            'attemptedUrl' => session('attemptedUrl')
        ]);
    }
}
