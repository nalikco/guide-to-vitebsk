<?php

namespace App\Services\Telegram\InitData;

use App\Contracts\Telegram\InitDataCheckerServiceInterface;
use App\Dto\Telegram\InitDto;

class InitDataCheckerService implements InitDataCheckerServiceInterface
{
    #[\Override]
    public function check(string $botToken, InitDto $initData): bool
    {
        $initDataArray = $initData->toArray();
        $initDataArray['user'] = $initData->user->toJson();

        unset($initDataArray['hash']);
        ksort($initDataArray);
        $dataCheckString = implode("\n", array_map(
            fn ($n, $v) => "$n=$v",
            array_keys($initDataArray),
            $initDataArray,
        ));

        $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);
        $key = hash_hmac('sha256', $dataCheckString, $secretKey);

        return $key === $initData->hash;
    }
}
