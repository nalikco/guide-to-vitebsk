<?php

namespace App\Filament\Traits;

use Illuminate\Support\Collection;

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
        $this->images->each(function (string $image) {
            $pathInfo = pathinfo($image);
            $fileName = $pathInfo['filename'];
            $extension = $pathInfo['extension'];

            $this->record->images()->create([
                'path' => $this->record->getImagePath(),
                'name' => $fileName,
                'extension' => $extension,
            ]);
        });
    }
}
