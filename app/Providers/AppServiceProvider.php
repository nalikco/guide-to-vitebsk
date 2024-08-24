<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Telegram\InitDataCheckerServiceContract;
use App\Contracts\Telegram\TokenServiceContract;
use App\Contracts\Uploads\ImageServiceContract;
use App\Contracts\Users\AuthenticateServiceContract;
use App\Contracts\Users\UserServiceContract;
use App\Services\Telegram\InitDataCheckerService;
use App\Services\Telegram\TestTokenService;
use App\Services\Telegram\TokenService;
use App\Services\Uploads\ImageService;
use App\Services\Users\AuthenticateService;
use App\Services\Users\UserService;
use Illuminate\Support\ServiceProvider;
use Override;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[Override]
    public function register(): void
    {
        $this->app->singleton(ImageServiceContract::class, ImageService::class);

        $this->app->singleton(InitDataCheckerServiceContract::class, InitDataCheckerService::class);

        $this->app->singleton(AuthenticateServiceContract::class, AuthenticateService::class);
        $this->app->singleton(UserServiceContract::class, UserService::class);

        if ($this->app->environment('local')) {
            $this->app->singleton(TokenServiceContract::class, TestTokenService::class);
        } else {
            $this->app->singleton(TokenServiceContract::class, TokenService::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
