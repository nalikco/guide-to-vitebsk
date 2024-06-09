<?php

namespace App\Filament\Traits;

use App\Models\PlaceImage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait EditableImages
{
    protected Collection $images;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = static::getRecord();

        foreach ($record->images as $image) {
            $data['images'][] = sprintf("%s/%s.%s", PlaceImage::IMAGES_PATH, $image->name, $image->extension);
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
        DB::transaction(function () {
            $this->record->images()->forceDelete();

            $this->images->each(function (string $image) {
                $pathInfo = pathinfo($image);
                $fileName = $pathInfo['filename'];
                $extension = $pathInfo['extension'];

                $this->record->images()->create([
                    'name' => $fileName,
                    'extension' => $extension,
                ]);
            });
        });
    }
}
