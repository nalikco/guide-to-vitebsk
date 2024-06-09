<?php

namespace App\Contracts\Telegraph;

use App\Models\TelegraphBot;

interface BotProvider
{
    /**
     * Retrieve the Telegraph bot instance.
     *
     * @return TelegraphBot The Telegraph bot instance.
     */
    public function getBot(): TelegraphBot;
}
