<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Tymon\JWTAuth\Console\JWTGenerateSecretCommand;

class InstallSeoera extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:seoera';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations and seeders for the SEOERA task';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting SEOERA Project Installation...');

        if (!file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
            $this->info('✅ .env file created from .env.example');
            $this->warn("Please edit the .env file now to configure your database and other settings.");
            $this->warn("File path: " . base_path('.env'));

            $this->error("After editing the file, re-run this command to continue installation.");
            return;
        }

        if ($this->confirm('Do you want to run migrations now?', true)) {
            $this->call('migrate');
            $this->info('✅ Migrations executed');
        }

        $this->call('optimize:clear');
        $this->info('✅ Optimizations cleared');

        $this->runShellCommand('composer install', '✅ Composer dependencies installed');

        $this->callSilent('key:generate');
        $this->info('✅ Application key generated');

        if (class_exists(JWTGenerateSecretCommand::class)) {
            $this->call('jwt:secret');
            $this->info('✅ JWT secret generated');
        }

        if ($this->confirm('Do you want to run the seeders now?', true)) {
            $userCount = $this->ask('How many users do you want to seed?', 10);
            config(['seoera_seeder_count.user_count' => $userCount]);
            $this->call('db:seed', ['--class' => 'UserSeeder']);
            $this->info("✅ Created {$userCount} users");

            $postCount = $this->ask('How many posts do you want to seed?', 50);
            config(['seoera_seeder_count.post_count' => $postCount]);
            $this->call('db:seed', ['--class' => 'PostSeeder']);
            $this->info("✅ Created {$postCount} posts");
        }

        if (file_exists(base_path('package.json')) && $this->confirm('Do you want to install and build frontend assets?', true)) {
            $this->runShellCommand('npm install', '✅ NPM packages installed');
            $this->runShellCommand('npm run build', '✅ Frontend assets built');
        }

        $this->info('🎯 SEOERA Project installation complete!');
    }

    /**
     * Run a shell command and display success message
     */
    private function runShellCommand($command, $successMessage)
    {
        exec($command, $output, $returnCode);
        if ($returnCode === 0) {
            $this->info($successMessage);
        } else {
            $this->error("❌ Failed to run: {$command}");
        }
    }
}
