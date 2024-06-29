<?php

namespace App\Services\Telegram;

use App\DTO\Telegram\TelegramInitData;

class TelegramInitDataCheckerService
{
    /**
     * Check if the provided init data match the hash value.
     *
     * @param  string  $botToken  The Telegram Bot token.
     * @param  TelegramInitData  $initData  An object containing data values to be checked.
     * @return bool Returns true if the hash matches the calculated hash from the data values, false otherwise.
     */
    public static function check(string $botToken, TelegramInitData $initData): bool
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
