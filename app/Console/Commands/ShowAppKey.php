<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowAppKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:show-app-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info(env('APP_KEY'));

    }
}
