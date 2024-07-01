<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AuthenticateController extends Controller
{
    public function authenticate(): View
    {
        return view('authenticate/authenticate');
    }
}
