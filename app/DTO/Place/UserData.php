<?php

declare(strict_types=1);

namespace App\DTO\Place;

use App\Models\User;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserData extends Data
{
    public function __construct(
        public int $telegramId,
        public string $firstName,
        public string $lastName,
        public string $username,
        public string $languageCode,
        public bool $allowsWriteToPm,
    ) {}

    public static function fromUser(User $user): self
    {
        return self::from([
            'telegramId' => $user->telegram_id,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'username' => $user->username,
            'languageCode' => $user->language_code,
            'allowsWriteToPm' => $user->allows_write_to_pm,
        ]);
    }
}
