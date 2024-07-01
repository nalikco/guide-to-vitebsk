<?php

namespace App\Services\Telegram\InitData;

use App\Contracts\Telegram\InitDataCheckerServiceInterface;
use Override;

class InitDataCheckerService implements InitDataCheckerServiceInterface
{
    #[Override]
    public function check(string $botToken, string $initData): bool
    {
        parse_str($initData, $initDataValues);
        $initDataValues = array_filter($initDataValues, is_string(...), ARRAY_FILTER_USE_KEY);

        $hash = $initDataValues['hash'] ?? null;

        unset($initDataValues['hash']);
        ksort($initDataValues);
        $dataCheckString = implode("\n", array_map(
            fn ($n, $v) => "$n=$v",
            array_keys($initDataValues),
            $initDataValues,
        ));

        $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);
        $key = hash_hmac('sha256', $dataCheckString, $secretKey);

        return $key === $hash;
    }
}
