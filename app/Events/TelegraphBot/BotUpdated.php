<?php

namespace App\Events\TelegraphBot;

use App\Contracts\Telegraph\BotProvider;
use App\Models\TelegraphBot;
use Illuminate\Foundation\Events\Dispatchable;

class BotUpdated implements BotProvider
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(private readonly TelegraphBot $bot)
    {
    }

    #[\Override]
    public function getBot(): TelegraphBot
    {
        return $this->bot;
    }
}
