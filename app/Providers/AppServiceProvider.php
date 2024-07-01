<?php

namespace App\Providers;

use App\Contracts\Telegram\InitDataCheckerServiceInterface;
use App\Contracts\Telegram\TokenGetterInterface;
use App\Contracts\User\UserCreatorInterface;
use App\Services\Telegram\InitData\InitDataCheckerService;
use App\Services\Telegram\Token\TokenGetterFake;
use App\Services\Telegram\Token\TokenProviderService;
use App\Services\User\UserProviderService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Override;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[Override]
    public function register(): void
    {
        $this->app->singleton(InitDataCheckerServiceInterface::class, InitDataCheckerService::class);
        $this->app->singleton(UserCreatorInterface::class, UserProviderService::class);

        if ($this->app->environment('production')) {
            $this->app->singleton(TokenGetterInterface::class, TokenProviderService::class);
        } else {
            $this->app->singleton(TokenGetterInterface::class, TokenGetterFake::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (App::isProduction() && Str::contains(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
