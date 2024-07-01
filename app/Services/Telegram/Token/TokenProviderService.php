<?php

namespace App\Services\Telegram\Token;

use App\Contracts\Telegram\TokenGetterInterface;
use App\Models\TelegraphBot;
use Override;

class TokenProviderService implements TokenGetterInterface
{
    #[Override]
    public function get(): string
    {
        return TelegraphBot::query()->first()->token;
    }
}
