<?php

namespace App\Services\User;

use App\Contracts\User\UserCreatorInterface;
use App\Dto\Telegram\UserDto;
use App\Models\User;
use Override;

class UserProviderService implements UserCreatorInterface
{
    #[Override]
    public function getOrCreate(UserDto $dto): User
    {
        return User::query()->firstOrCreate([
            'telegram_id' => $dto->id,
        ], [
            ...$dto->toArray(),
            'telegram_id' => $dto->id,
        ]);
    }
}
