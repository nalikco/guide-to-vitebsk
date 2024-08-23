<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function view(): Response
    {
        return Inertia::render('login', [
            'auth.route' => route('login'),
        ]);
    }

    public function handle() {}
}
