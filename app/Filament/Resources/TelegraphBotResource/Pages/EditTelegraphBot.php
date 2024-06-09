<?php

namespace App\Filament\Resources\TelegraphBotResource\Pages;

use App\Filament\Resources\TelegraphBotResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTelegraphBot extends EditRecord
{
    protected static string $resource = TelegraphBotResource::class;

    #[\Override]
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
