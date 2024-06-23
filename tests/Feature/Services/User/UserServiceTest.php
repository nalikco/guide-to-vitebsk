<?php

use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;

uses(RefreshDatabase::class);

it('create', function () {
    $username = '';
    $service = App::make(UserService::class);

    $createdUser = $service->create($username);
    expect(User::query()->count())->toBe(1)
        ->and($createdUser->username)->toBe($username);
});
