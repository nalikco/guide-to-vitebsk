<?php

namespace App\DTO\Telegram;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class TelegramInitData extends Data
{
    public function __construct(
        #[MapName('auth_date')]
        public string $authDate,
        #[MapName('query_id')]
        public string $queryId,
        public TelegramUserData $user,
        public string $hash,
    ) {
    }
}
