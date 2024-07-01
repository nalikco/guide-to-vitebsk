<?php

namespace App\Factories\Telegram;

use App\Dto\Telegram\InitDto;

class InitDtoFactory
{
    public static function make(string $initData): InitDto
    {
        $initDataValues = [];
        parse_str($initData, $initDataValues);

        $user = json_decode($initDataValues['user'], true);

        return InitDto::from([
            ...$initDataValues,
            'user' => $user,
        ]);
    }
}
