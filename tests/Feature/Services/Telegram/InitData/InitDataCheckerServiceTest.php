<?php

use App\Dto\Telegram\InitDto;
use App\Services\Telegram\InitData\InitDataCheckerService;

$token = 'a3c8f1bd39c3666a18a92a8d290dc167d71be95e2df899a4b30526a48b9b0a67';
$initDataArray = [
    'auth_date' => '1712603287',
    'query_id' => 'QoCJwq2LEOltYeZ0',
    'user' => [
        'id' => 3453455,
        'first_name' => 'John',
        'last_name' => 'Doe',
        'username' => 'johndoe',
        'language_code' => 'en',
        'allows_write_to_pm' => true,
    ],
    'hash' => 'a572c00d30c1407ec9d7357241b1558c6ec5fcc41cffe6484d0efca54423511b',
];

it('should check', function () use ($token, $initDataArray) {
    $dataChecker = $this->app->make(InitDataCheckerService::class);
    $result = $dataChecker->check($token, InitDto::from($initDataArray));

    expect($result)->toBeTrue();
});

it('should return false: invalid token', function () use ($initDataArray) {
    $dataChecker = $this->app->make(InitDataCheckerService::class);
    $result = $dataChecker->check('invalid', InitDto::from($initDataArray));

    expect($result)->toBeFalse();
});

it('should return false: invalid hash', function () use ($token, $initDataArray) {
    $localInitDataArray = [...$initDataArray, 'hash' => 'invalid'];

    $dataChecker = $this->app->make(InitDataCheckerService::class);
    $result = $dataChecker->check($token, InitDto::from($localInitDataArray));

    expect($result)->toBeFalse();
});

it('should return false: invalid struct', function () use ($token, $initDataArray) {
    $localInitDataArray = [...$initDataArray, 'user' => [...$initDataArray['user'], 'id' => 0]];

    $dataChecker = $this->app->make(InitDataCheckerService::class);
    $result = $dataChecker->check($token, InitDto::from($localInitDataArray));

    expect($result)->toBeFalse();
});
