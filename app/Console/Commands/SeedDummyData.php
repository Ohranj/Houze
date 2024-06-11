<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedDummyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-dummy-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with dummy data. See /database/seeders/DummySeeder.php';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $env = config('app.env');

        if ('local' !== $env) {
            $this->fail("Command only to be used in local environment. Your current environment: {$env}");
        }

        $agreed = $this->confirm('Proceeding will refresh the database and populate it with dummy data. Are you happy to proceed?', false);

        if ( ! $agreed) {
            $this->info('Command aborted. No changes made.');
            return 1;
        }

        $this->call('migrate:fresh');
        $this->call('db:seed', ['class' => 'DummySeeder']);

        $this->info('Command complete.');
    }
}
