<?php

namespace App\DTO\Telegram;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class TelegramUserData extends Data
{
    public function __construct(
        public int    $id,
        #[MapName('telegram_id')]
        public int    $telegramId,
        #[MapName('first_name')]
        public string $firstName,
        #[MapName('last_name')]
        public string $lastName,
        public string $username,
        #[MapName('language_code')]
        public string $languageCode,
        #[MapName('allows_write_to_pm')]
        public bool   $allowsWriteToPm,
    )
    {
    }
}
