<?php

namespace App\Console\Commands;

use App\Models\Donation;
use Illuminate\Console\Command;

class populate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the database with sample data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Donation::factory()->count(5)->create();
        $this->info('Congratulations! Data has been populated successfully.');
    }
}
