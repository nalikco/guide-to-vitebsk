<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use App\Contracts\Telegram\TokenServiceContract;
use Override;

readonly class TestTokenService implements TokenServiceContract
{
    #[Override]
    public function get(): string
    {
        return 'a3c8f1bd39c3666a18a92a8d290dc167d71be95e2df899a4b30526a48b9b0a67';
    }
}
