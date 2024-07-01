<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AuthenticateController extends Controller
{
    public function __construct(private readonly \Illuminate\Contracts\View\Factory $viewFactory) {}

    public function authenticate(): View
    {
        return $this->viewFactory->make('authenticate/authenticate');
    }
}
