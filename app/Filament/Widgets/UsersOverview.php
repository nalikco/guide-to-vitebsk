<?php

namespace App\Filament\Widgets;

use App\Models\TelegraphBot;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Override;

class UsersOverview extends BaseWidget
{
    #[Override]
    protected function getStats(): array
    {
        $botStatusValue = '';
        $botStatusDescription = 'не создан';
        $botStatusColor = 'danger';

        if ($bot = TelegraphBot::query()->first()) {
            $botStatusValue = $bot->name;
            $botStatusDescription = 'активен';
            $botStatusColor = 'success';
        }

        return [
            Stat::make('Статус Telegram бота', $botStatusValue)
                ->description($botStatusDescription)
                ->color($botStatusColor),
        ];
    }
}
