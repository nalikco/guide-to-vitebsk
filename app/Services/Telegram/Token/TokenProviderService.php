<?php

namespace App\Services\Telegram\Token;

use App\Contracts\Telegram\TokenGetterInterface;
use App\Models\TelegraphBot;
use Override;
use Psr\Log\LoggerInterface;

class TokenProviderService implements TokenGetterInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    #[Override]
    public function get(): string
    {
        $bot = TelegraphBot::query()->first();

        $this->logger->info('bot received', [
            'op' => __METHOD__,
            'bot_id' => $bot->id,
            'bot_name' => $bot->name,
        ]);

        return $bot->token;
    }
}
