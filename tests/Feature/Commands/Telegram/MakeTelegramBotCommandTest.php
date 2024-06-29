<?php

use App\Events\TelegraphBot\BotCreated;
use App\Models\TelegraphBot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Symfony\Component\Console\Command\Command as CommandAlias;

uses(RefreshDatabase::class);

it('should create', function () {
    Event::fake();

    $token = 'token';
    expect(TelegraphBot::query()
        ->where('token', $token)
        ->count())->toBe(0);

    $this->artisan('make:telegram-bot')
        ->expectsQuestion('Please, enter token:', $token)
        ->expectsQuestion('Please, enter name:', 'Name')
        ->assertExitCode(CommandAlias::SUCCESS);

    $bot = TelegraphBot::query()
        ->where('token', $token)
        ->first();

    Event::assertDispatched(BotCreated::class);

    expect($bot)->toBeInstanceOf(TelegraphBot::class)
        ->and($bot->name)->toBe('Name')
        ->and($bot->token)->toBe($token)
        ->and(TelegraphBot::query()->count())->toBe(1);
});

it('should get', function () {
    Event::fake();

    $token = 'token';

    TelegraphBot::query()->create([
        'token' => $token,
        'name' => 'Name',
    ]);

    $this->artisan('make:telegram-bot')
        ->expectsQuestion('Please, enter token:', $token)
        ->expectsQuestion('Please, enter name:', 'Name')
        ->assertExitCode(CommandAlias::SUCCESS);

    $bot = TelegraphBot::query()
        ->where('token', $token)
        ->first();

    expect($bot)->toBeInstanceOf(TelegraphBot::class)
        ->and($bot->name)->toBe('Name')
        ->and($bot->token)->toBe($token)
        ->and(TelegraphBot::query()->count())->toBe(1);
});
