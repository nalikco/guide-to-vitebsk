<?php

namespace App\Services;

use App\Contracts\Imageable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Psr\Log\LoggerInterface;

class UploadService
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    /**
     * Replaces all images of the desired model.
     *
     * @param  Imageable  $imageable  The model for which images need to be replaced.
     * @param  Collection<int, string>  $images  Replaceable images. Example image: "places/qwerty.jpg"
     * @return Imageable Updated model.
     */
    public function replaceImages(Imageable $imageable, Collection $images): Imageable
    {
        $op = __METHOD__;

        return DB::transaction(function () use ($op, $imageable, $images) {
            $imageable->images()->forceDelete();

            $this->logger->info('images deleted', [
                'op' => $op,
                'imageable_id' => $imageable->getId(),
                'images' => $images->toArray(),
            ]);

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

            $this->logger->info('images created', [
                'op' => $op,
                'imageable_id' => $imageable->getId(),
                'images' => $images->toArray(),
            ]);

            return $imageable;
        });
    }
}
