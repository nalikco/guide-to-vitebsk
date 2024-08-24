<?php

declare(strict_types=1);

namespace App\DTO\Place;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserData extends Data
{
    public function __construct(
        #[MapName('id')]
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
        public Carbon $createdAt,
    ) {}
}
