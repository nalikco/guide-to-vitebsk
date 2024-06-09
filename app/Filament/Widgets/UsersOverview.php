<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersOverview extends BaseWidget
{
    #[\Override]
    protected function getStats(): array
    {
        return [
            Stat::make('Telegram пользователи', '192.1k')
                ->description('на 32% больше за 7 дней')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Действий в день', '192.1k')
                ->description('на 32k больше')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Показов карточек в день', '192.1k')
                ->description('на 32k больше')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
