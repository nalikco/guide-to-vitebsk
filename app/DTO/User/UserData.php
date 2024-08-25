<?php

declare(strict_types=1);

namespace App\DTO\User;

use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserData extends Data
{
    public function __construct(
        public int $id,
        public int $telegramId,
        public string $firstName,
        public string $lastName,
        public string $username,
        public string $languageCode,
        public bool $allowsWriteToPm,
        public Carbon $createdAt,
    ) {}

    public static function fromUser(User $user): self
    {
        return self::from([
            'id' => $user->id,
            'telegramId' => $user->telegram_id,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'username' => $user->username,
            'languageCode' => $user->language_code,
            'allowsWriteToPm' => $user->allows_write_to_pm,
            'createdAt' => $user->created_at,
        ]);
    }
}
