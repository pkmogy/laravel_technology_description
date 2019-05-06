<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class invokeController extends Controller
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        return redirect('main');
    }
}
