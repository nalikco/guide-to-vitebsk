<?php

namespace App\Services\Telegram\Token;

use App\Contracts\Telegram\TokenGetterInterface;
use Override;

class TokenGetterFake implements TokenGetterInterface
{
    #[Override]
    public function get(): string
    {
        return 'a3c8f1bd39c3666a18a92a8d290dc167d71be95e2df899a4b30526a48b9b0a67';
    }
}
