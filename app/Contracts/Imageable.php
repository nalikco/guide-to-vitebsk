<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Imageable
{
    public function getId(): int;

    /**
     * Returns the path where images are stored.
     *
     * @return string Path.
     */
    public function getImagesPath(): string;

    public function images(): MorphMany;
}
