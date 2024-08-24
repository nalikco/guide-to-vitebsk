<?php

declare(strict_types=1);

use App\Services\Telegram\TokenService;
use Illuminate\Support\Facades\Config;

it('should get token from config', function () {
    $token = 'token';

    Config::set('telegram.token', $token);

    $service = new TokenService;

    expect($service->get())->toBe($token);
});
