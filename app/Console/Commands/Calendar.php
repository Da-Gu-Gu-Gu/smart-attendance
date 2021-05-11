<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\MyEvent;

class Calendar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calendar:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calendar Schedule notification sent to respective everyone';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        event(new MyEvent("dr ka test nw brooo!"));
        $this->info('Successfully sent daily quote to everyone.');
    }
}
