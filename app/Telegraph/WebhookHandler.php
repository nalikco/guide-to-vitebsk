<?php

namespace App\Telegraph;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler as TelegraphWebhookHandler;
use DefStudio\Telegraph\Keyboard\Keyboard;

class WebhookHandler extends TelegraphWebhookHandler
{
    public function start(): void
    {
        $this->reply(__('messages.start'));
    }

    public function menu(): void
    {
        Telegraph::bot($this->bot)
            ->message(__('messages.menu'))
            ->keyboard(function (Keyboard $keyboard) {
                $keyboard->button('Посмотреть категории')->action('plcCats');
                $keyboard->button('Топ мест')->action('plcTop');

                return $keyboard;
            })
            ->send();
    }
}
