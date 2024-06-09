<?php

namespace App\Filament\Resources\TelegraphBotResource\Pages;

use App\Filament\Resources\TelegraphBotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTelegraphBots extends ListRecords
{
    protected static string $resource = TelegraphBotResource::class;

    #[\Override]
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
