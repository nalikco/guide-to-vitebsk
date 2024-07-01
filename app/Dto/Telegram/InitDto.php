<?php

namespace App\Dto\Telegram;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class InitDto extends Data
{
    public function __construct(
        #[MapName('auth_date')]
        public string $authDate,
        #[MapName('query_id')]
        public string $queryId,
        public UserDto $user,
        public string $hash,
    ) {}
}
