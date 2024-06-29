<?php

namespace App\DTO\User;

use App\Dto\Telegram\TelegramUserData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $username,
        public TelegramUserData $telegramUser,
        #[MapName('created_at')]
        public string $createdAt,
        #[MapName('updated_at')]
        public string $updatedAt,
    ) {
    }
}
