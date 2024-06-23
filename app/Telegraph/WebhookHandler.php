<?php

namespace App\Telegraph;

use DefStudio\Telegraph\Handlers\WebhookHandler as TelegraphWebhookHandler;

class WebhookHandler extends TelegraphWebhookHandler
{
    public function start(): void
    {
        $this->reply(__('messages.start'));
    }
}
