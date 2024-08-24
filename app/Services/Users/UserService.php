<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\Contracts\Users\UserServiceContract;
use App\DTO\Telegram\UserData;
use App\Models\User;

readonly class UserService implements UserServiceContract
{
    #[\Override]
    public function firstOrCreate(UserData $data): User
    {
        return User::query()->firstOrCreate([
            'telegram_id' => $data->id,
        ], $data->toArray());
    }
}
