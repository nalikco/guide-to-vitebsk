<?php

declare(strict_types=1);

namespace App\DTO\Place;

use App\Models\PlaceCategory;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PlaceCategoryData extends Data
{
    public function __construct(
        public ?self $parent,
        public string $name,
        public string $imageUrl,
    ) {}

    public static function fromPlaceCategory(PlaceCategory $category): self
    {
        return self::from([
            'parent' => $category->parent,
            'name' => $category->name,
            'imageUrl' => $category->image->public_path,
        ]);
    }
}
