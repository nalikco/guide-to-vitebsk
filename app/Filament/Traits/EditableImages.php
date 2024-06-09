<?php

namespace App\Filament\Traits;

use App\Services\UploadService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

trait EditableImages
{
    protected Collection $images;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = static::getRecord();

        foreach ($record->images as $image) {
            $data['images'][] = sprintf("%s/%s.%s", $this->record->getImagesPath(), $image->name, $image->extension);
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->images = collect($data['images']);

        return $data;
    }

    protected function afterSave(): void
    {
        $uploadService = App::make(UploadService::class);
        $this->record = $uploadService->replaceImages($this->record, $this->images);
    }
}
