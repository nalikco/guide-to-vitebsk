<?php

use App\Models\TelegraphBot;
use App\Services\Telegram\Token\TokenProviderService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should get', function () {
    $bot = TelegraphBot::query()->create([
        'token' => 'token',
        'name' => 'Name',
    ]);

    $provider = $this->app->make(TokenProviderService::class);

    $result = $provider->get();

    expect($bot->token)->toBe($result);
});
