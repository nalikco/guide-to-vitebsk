<?php

namespace App\Listeners\TelegraphBot;

use App\Contracts\Telegraph\BotProvider;

class SetupWebhook
{
    /**
     * Handle the event to set up the webhook for the Telegraph bot.
     *
     * @param  BotProvider  $provider  The bot provider instance that supplies the Telegraph bot.
     */
    public function handle(BotProvider $provider): void
    {
        $bot = $provider->getBot();

        $bot->registerCommands([])->send();
        $bot->registerWebhook()->send();
    }
}
