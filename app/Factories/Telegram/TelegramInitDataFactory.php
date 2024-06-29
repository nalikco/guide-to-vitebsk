<?php

namespace App\Factories\Telegram;

use App\DTO\Telegram\TelegramInitData;

class TelegramInitDataFactory
{
    public static function make(string $initData): TelegramInitData
    {
        $initDataValues = [];
        parse_str($initData, $initDataValues);

        $user = json_decode($initDataValues['user'], true);

        return TelegramInitData::from([
            ...$initDataValues,
            'user' => $user,
        ]);
    }
}
