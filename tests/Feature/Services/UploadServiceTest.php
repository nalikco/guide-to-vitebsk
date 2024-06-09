<?php

use App\Contracts\Imageable;
use App\Services\UploadService;
use Illuminate\Support\Collection;
use Mockery\MockInterface;

it('can replace images', function () {
    $images = collect(['places/name.png', 'places/name.jpg']);

    $morphManyMock = Mockery::mock(Illuminate\Database\Eloquent\Relations\MorphMany::class, function (MockInterface $mock) {
        $mock->shouldReceive('forceDelete')->once();
        $mock->shouldReceive('createMany')
            ->once()
            ->andReturnUsing(function (Collection $images) {
                expect($images->toArray())->toEqual([[
                    'path' => 'places',
                    'name' => 'name',
                    'extension' => 'png',
                ], [
                    'path' => 'places',
                    'name' => 'name',
                    'extension' => 'jpg',
                ]]);
            });

        return $mock;
    });

    $imageable = Mockery::mock(Imageable::class, function (MockInterface $mock) use ($morphManyMock) {
        $mock->shouldReceive('images')
            ->andReturn($morphManyMock);
        $mock->shouldReceive('getImagesPath')->andReturn('places');

        return $mock;
    });

    $uploadService = new UploadService();
    $uploadService->replaceImages($imageable, $images);
});
