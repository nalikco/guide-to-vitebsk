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
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Authenticator extends Component
{
    /**
     * @throws BindingResolutionException
     */
    public function authenticate(string $initDataString): void
    {
        $op = __METHOD__;
        $logger = app()->make(LoggerInterface::class);

        $token = app()->make(TokenGetterInterface::class)->get();
        $dataCheckerService = app()->make(InitDataCheckerServiceInterface::class);

        $logger->info('token received', [
            'op' => $op,
            'init_data' => $initDataString,
        ]);

        if (! $dataCheckerService->check($token, $initDataString)) {
            $logger->warning('invalid init data', [
                'op' => $op,
                'init_data' => $initDataString,
            ]);

            throw new UnauthorizedHttpException('Invalid Telegram data.');
        }

        $initData = InitDtoFactory::make($initDataString);

        $userCreator = app()->make(UserCreatorInterface::class);
        $user = $userCreator->getOrCreate($initData->user);

        $logger->warning('user created', [
            'op' => $op,
            'init_data' => $initDataString,
            'user_id' => $user->id,
        ]);

        Auth::login($user, true);

        $logger->warning('user authenticated', [
            'op' => $op,
            'init_data' => $initDataString,
            'user_id' => $user->id,
        ]);

        $this->redirectRoute('home');
    }

    public function render(): View
    {
        return view('livewire.telegram.authenticator');
    }
}
