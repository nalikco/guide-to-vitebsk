<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(private readonly \Illuminate\Contracts\View\Factory $viewFactory) {}

    public function home(): View
    {
        return $this->viewFactory->make('home');
    }
}
