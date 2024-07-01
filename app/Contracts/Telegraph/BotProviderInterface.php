<?php

namespace App\Contracts\Telegraph;

use App\Models\TelegraphBot;

interface BotProviderInterface
{
    public function getBot(): TelegraphBot;
}
