<?php

namespace App\Console\Commands;

use App\Models\Donation;
use App\Models\Donator;
use Illuminate\Console\Command;

class seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed';

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
        Donator::factory()->count(5)->create();
        Donation::factory()->count(5)->create();
    }
}
