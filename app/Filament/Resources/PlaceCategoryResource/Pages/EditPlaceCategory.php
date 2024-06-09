<?php

namespace App\Filament\Resources\PlaceCategoryResource\Pages;

use App\Filament\Resources\PlaceCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlaceCategory extends EditRecord
{
    protected static string $resource = PlaceCategoryResource::class;

    #[\Override]
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
