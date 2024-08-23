<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use App\Contracts\Telegram\TokenServiceContract;
use League\Config\ConfigurationInterface;
use Override;

readonly class TokenService implements TokenServiceContract
{
    public function __construct(
        private ConfigurationInterface $config,
    ) {}

    #[Override]
    public function get(): string
    {
        return $this->config->get('telegram.token');
    }
}
