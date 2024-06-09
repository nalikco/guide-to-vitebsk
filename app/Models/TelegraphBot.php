<?php

namespace App\Models;

use App\Events\TelegraphBot\BotCreated;
use App\Events\TelegraphBot\BotUpdated;

class TelegraphBot extends \DefStudio\Telegraph\Models\TelegraphBot
{
    protected $dispatchesEvents = [
        'creating' => BotCreated::class,
        'updating' => BotUpdated::class,
    ];
}
