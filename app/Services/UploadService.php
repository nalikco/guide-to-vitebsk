<?php

namespace App\Services;

use App\Contracts\Imageable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UploadService
{
    /**
     * Replaces all images of the desired model.
     *
     * @param  Imageable  $imageable  The model for which images need to be replaced.
     * @param  Collection<int, string>  $images  Replaceable images. Example image: "places/qwerty.jpg"
     * @return Imageable Updated model.
     */
    public function replaceImages(Imageable $imageable, Collection $images): Imageable
    {
        return DB::transaction(function () use ($imageable, $images) {
            $imageable->images()->forceDelete();

            $imageable->images()->createMany($images->map(function (string $image) use ($imageable) {
                $pathInfo = pathinfo($image);
                $fileName = $pathInfo['filename'];
                $extension = $pathInfo['extension'];

                return [
                    'path' => $imageable->getImagesPath(),
                    'name' => $fileName,
                    'extension' => $extension,
                ];
            }));

            return $imageable;
        });
    }
}
