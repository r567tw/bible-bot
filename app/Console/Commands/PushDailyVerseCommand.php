<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DailyVerseService;
use App\Services\LineBotService;

class PushDailyVerseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:DailyVerse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'push daily verse of taiwanbible.com';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DailyVerseService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bot = new LineBotService(env('LINE_USER_ID'));
        $bot->pushMessage($this->service->getDailyVerse());
    }
}
