<?php

declare(strict_types=1);

namespace App\DTO\Place;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PlaceCategoryData extends Data
{
    public function __construct(
        public ?self $parent,
        public string $name,

        #[MapName('image_url')]
        public string $imageUrl,
    ) {}
}
