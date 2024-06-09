<?php

namespace App\Filament\Traits;

use App\Services\UploadService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

trait CreatableImages
{
    protected Collection $images;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->images = collect($data['images']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $uploadService = App::make(UploadService::class);
        $this->record = $uploadService->replaceImages($this->record, $this->images);
    }
}
