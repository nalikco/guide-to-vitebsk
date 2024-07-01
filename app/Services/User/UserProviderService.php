<?php

namespace App\Services\User;

use App\Contracts\User\UserCreatorInterface;
use App\Dto\Telegram\UserDto;
use App\Models\User;
use Override;
use Psr\Log\LoggerInterface;

class UserProviderService implements UserCreatorInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    #[Override]
    public function getOrCreate(UserDto $dto): User
    {
        $user = User::query()->firstOrCreate([
            'telegram_id' => $dto->id,
        ], [
            ...$dto->toArray(),
            'telegram_id' => $dto->id,
        ]);

        $this->logger->info('user received or created', [
            'op' => __METHOD__,
            'telegram_id' => $dto->id,
            'id' => $user->id,
        ]);

        return $user;
    }
}
