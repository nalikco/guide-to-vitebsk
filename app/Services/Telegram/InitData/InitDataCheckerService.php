<?php

namespace App\Services\Telegram\InitData;

use App\Contracts\Telegram\InitDataCheckerServiceInterface;
use Override;
use Psr\Log\LoggerInterface;

class InitDataCheckerService implements InitDataCheckerServiceInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    #[Override]
    public function check(string $botToken, string $initData): bool
    {
        $op = __METHOD__;

        parse_str($initData, $initDataValues);
        $initDataValues = array_filter($initDataValues, is_string(...), ARRAY_FILTER_USE_KEY);

        $hash = $initDataValues['hash'] ?? null;

        $this->logger->info('values prepared', [
            'op' => $op,
            'values' => $initDataValues,
        ]);

        unset($initDataValues['hash']);
        ksort($initDataValues);
        $dataCheckString = implode("\n", array_map(
            fn ($n, $v) => "$n=$v",
            array_keys($initDataValues),
            $initDataValues,
        ));

        $this->logger->info('values concatenated', [
            'op' => $op,
            'values' => $initDataValues,
        ]);

        $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);
        $key = hash_hmac('sha256', $dataCheckString, $secretKey);

        $this->logger->info('hash generated', [
            'op' => $op,
            'secret_key' => $secretKey,
            'key' => $key,
        ]);

        return $key === $hash;
    }
}
