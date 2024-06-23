<?php

namespace App\Console\Commands\Telegram;

use App\Models\TelegraphBot;
use Illuminate\Console\Command;

class ConfigureBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:configure-bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up the bot. Needed when setting up for the first time or after changing the token.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $bot = TelegraphBot::query()->firstOrCreate([
            'token' => config('telegram.bot_token'),
        ], [
            'name' => '',
        ]);

        $bot->registerCommands([])->send();
        $bot->registerWebhook()->send();

        return self::SUCCESS;
    }
}
