<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Telegram\InitDataCheckerServiceContract;
use App\Contracts\Telegram\TokenServiceContract;
use App\Contracts\Users\AuthenticateServiceContract;
use App\Contracts\Users\UserServiceContract;
use App\Factories\Telegram\InitDataFactory;
use App\Http\Requests\Telegram\LoginRequest;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function __construct(
        private readonly AuthenticateServiceContract $authenticateService,
        private readonly UserServiceContract $userService,
        private readonly InitDataCheckerServiceContract $initDataCheckerService,
        private readonly TokenServiceContract $tokenService,
    ) {}

    public function view(): Response
    {
        return Inertia::render('login', [
            'auth.route' => route('login'),
        ]);
    }

    public function handle(LoginRequest $request)
    {
        $initDataString = $request->init_data;
        if (! $this->initDataCheckerService->check(
            $this->tokenService->get(),
            $initDataString,
        )) {
            return redirect()->back()->withErrors([
                'init_data' => 'Invalid Telegram InitData.',
            ]);
        }

        $user = $this->userService->firstOrCreate(InitDataFactory::make($initDataString)->user);
        $this->authenticateService->authenticate($user);

        return Redirect::route('home');
    }
}
