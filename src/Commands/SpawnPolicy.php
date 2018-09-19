<?php

namespace AKoepcke\LaravelSpawn\Commands;

use AKoepcke\LaravelSpawn\Traits\SpawnFunctionsTrait;
use Illuminate\Console\Command;

class SpawnPolicy extends Command
{
    use SpawnFunctionsTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spawn:policy {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spawn a new ModelPolicy';

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
     * @return mixed
     */
    public function handle()
    {
        $this->initVars();
        $this->initDirs();
        $this->touchDirectory($this->policiesDir);

        $this->spawn_create(
            $this->policiesDir . '/' . $this->modelName . 'Policy.php',
            $this->getStubPath('Policies/Policy.stub')
        );

        $pattern = '/([\n]class AuthServiceProvider)/';
        $this->spawn_insert(
            app_path('Providers/AuthServiceProvider.php'),
            $this->getStubPath('Policies/PolicyImport.stub'),
            $pattern,
            'before'
        );

        $pattern = '/(protected \$policies = \[\s*[^\]]*)/';
        $this->spawn_insert(
            app_path('Providers/AuthServiceProvider.php'),
            $this->getStubPath('Policies/PolicyRegistration.stub'),
            $pattern
        );

        $this->info('...Created and registered the policy');
    }

}