<?php

namespace App\Console\Commands;

use App\MonopolyService;
use Illuminate\Console\Command;

class MonopolyParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monopoly:contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to start get data for contracts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new MonopolyService)->callContracts();
    }
}
