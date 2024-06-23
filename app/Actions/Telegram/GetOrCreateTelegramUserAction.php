<?php

namespace App\Actions\Telegram;

use App\Exceptions\Telegram\InvalidTelegramInitDataException;
use App\Models\User;
use App\Services\Telegram\TelegramUserService;

class GetOrCreateTelegramUserAction
{
    public function __construct(
        private readonly TelegramUserService $telegramUserService,
    ) {
    }

    /**
     * Get or create a user based on Telegram initialization data.
     *
     * @param  string  $botToken  The Telegram Bot token.
     * @param  string  $initData  The initialization data from Telegram.
     * @return User The created or existing user.
     *
     * @throws InvalidTelegramInitDataException If the Telegram initialization data is invalid.
     */
    public function handle(string $botToken, string $initData): User
    {

        return $this->telegramUserService->getOrCreate($botToken, $initData);
    }
}
