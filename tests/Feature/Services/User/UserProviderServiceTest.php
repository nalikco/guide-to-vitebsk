<?php

use App\Dto\Telegram\UserDto;
use App\Models\User;
use App\Services\User\UserProviderService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should get', function () {
    $provider = $this->app->make(UserProviderService::class);

    expect(User::query()->count())->toBe(0);

    $dto = UserDto::from([
        'id' => 3453455,
        'first_name' => 'John',
        'last_name' => 'Doe',
        'username' => 'johndoe',
        'language_code' => 'en',
        'allows_write_to_pm' => true,
    ]);

    $user = $provider->getOrCreate($dto);

    expect($user->telegram_id)->toBe($dto->id)
        ->and($user->first_name)->toBe($dto->firstName)
        ->and($user->last_name)->toBe($dto->lastName)
        ->and($user->username)->toBe($dto->username)
        ->and($user->language_code)->toBe($dto->languageCode)
        ->and($user->allows_write_to_pm)->toBe($dto->allowsWriteToPm)
        ->and(User::query()->count())->toBe(1);
});

it('should create', function () {
    $dto = UserDto::from([
        'id' => 3453455,
        'first_name' => 'John',
        'last_name' => 'Doe',
        'username' => 'johndoe',
        'language_code' => 'en',
        'allows_write_to_pm' => true,
    ]);

    User::query()->create([
        ...$dto->toArray(),
        'telegram_id' => $dto->id,
    ]);

    $provider = $this->app->make(UserProviderService::class);

    expect(User::query()->count())->toBe(1);

    $user = $provider->getOrCreate($dto);

    expect($user->telegram_id)->toBe($dto->id)
        ->and($user->first_name)->toBe($dto->firstName)
        ->and($user->last_name)->toBe($dto->lastName)
        ->and($user->username)->toBe($dto->username)
        ->and($user->language_code)->toBe($dto->languageCode)
        ->and($user->allows_write_to_pm)->toBe($dto->allowsWriteToPm)
        ->and(User::query()->count())->toBe(1);
});
