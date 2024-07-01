<?php

namespace App\Dto\User;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class UserDto extends Data
{
    public function __construct(
        public int $id,
        #[MapName('telegram_id')]
        public int $telegramId,
        #[MapName('first_name')]
        public string $firstName,
        #[MapName('last_name')]
        public string $lastName,
        public string $username,
        #[MapName('language_code')]
        public string $languageCode,
        #[MapName('allows_write_to_pm')]
        public bool $allowsWriteToPm,
        #[MapName('created_at')]
        public string $createdAt,
        #[MapName('updated_at')]
        public string $updatedAt,
    ) {}
}
