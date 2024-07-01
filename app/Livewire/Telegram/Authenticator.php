<?php

namespace App\Livewire\Telegram;

use App\Contracts\Telegram\InitDataCheckerServiceInterface;
use App\Contracts\Telegram\TokenGetterInterface;
use App\Contracts\User\UserCreatorInterface;
use App\Factories\Telegram\InitDtoFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Authenticator extends Component
{
    /**
     * @throws BindingResolutionException
     */
    public function authenticate(string $initDataString): void
    {
        $token = app()->make(TokenGetterInterface::class)->get();
        $initData = InitDtoFactory::make($initDataString);
        $dataCheckerService = app()->make(InitDataCheckerServiceInterface::class);

        if (! $dataCheckerService->check($token, $initData)) {
            throw new UnauthorizedHttpException('Invalid Telegram data.');
        }

        $userCreator = app()->make(UserCreatorInterface::class);
        $user = $userCreator->getOrCreate($initData->user);

        Auth::login($user, true);

        $this->redirectRoute('home');
    }

    public function render(): View
    {
        return view('livewire.telegram.authenticator');
    }
}
