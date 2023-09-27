<?php

namespace App\Console\Commands;

use Database\Seeders\QuestionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Console\Command;

class RefreshDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call("migrate:fresh");
        $this->call(UserSeeder::class);
        $this->call(QuestionSeeder::class);
    }
}
