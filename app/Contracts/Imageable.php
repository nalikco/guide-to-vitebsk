<?php

namespace App\Contracts;

interface Imageable
{
    /**
     * Returns the path where images are stored.
     *
     * @return string Path.
     */
    public function getImagesPath(): string;
}
