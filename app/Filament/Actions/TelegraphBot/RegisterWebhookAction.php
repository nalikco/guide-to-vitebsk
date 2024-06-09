<?php

namespace App\Filament\Actions\TelegraphBot;

use App\Models\TelegraphBot;
use Exception;
use Filament\Tables\Actions\Action;

class RegisterWebhookAction extends Action
{
    #[\Override]
    public static function getDefaultName(): ?string
    {
        return 'register-webhook';
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('telegraph.actions.webhook.title'));

        $this->successNotificationTitle(__('telegraph.actions.webhook.success_notification'));

        $this->icon('heroicon-m-wrench');

        $this->action(function (TelegraphBot $record): void {
            try {
                $record->registerWebhook()->send();
                $this->success();
            } catch (Exception $e) {
                $this->failureNotificationTitle(__('telegraph.actions.webhook.failure_notification', ['error' => $e->getMessage()]));
                $this->failure();
            }
        });
    }
}
