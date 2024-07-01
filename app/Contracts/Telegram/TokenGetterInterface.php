<?php

namespace App\Contracts\Telegram;

interface TokenGetterInterface
{
    /**
     * Returns the Telegram bot token.
     *
     * @return string Telegram bot token.
     */
    public function get(): string;
}
