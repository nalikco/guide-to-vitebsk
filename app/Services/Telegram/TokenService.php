<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use App\Contracts\Telegram\TokenServiceContract;
use Override;

readonly class TokenService implements TokenServiceContract
{
    #[Override]
    public function get(): string
    {
        return config('telegram.token');
    }
}
