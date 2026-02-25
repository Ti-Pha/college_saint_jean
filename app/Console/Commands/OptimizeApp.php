<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeApp extends Command
{
    protected $signature   = 'app:optimize';
    protected $description = 'Optimise l\'application pour la production';

    public function handle(): void
    {
        $this->info('Optimisation en cours...');

        $this->call('config:cache');
        $this->call('route:cache');
        $this->call('view:cache');
        $this->call('event:cache');

        $this->info('✅ Application optimisée avec succès.');
    }
}