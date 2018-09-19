<?php

namespace AKoepcke\LaravelSpawn\Commands;

use AKoepcke\LaravelSpawn\Traits\SpawnFunctionsTrait;
use Illuminate\Console\Command;

class SpawnDatabase extends Command
{
    use SpawnFunctionsTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spawn:database {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spawn migration, factory and seed files';

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
        $this->touchDirectory([
            $this->migrationsDir,
            $this->factoriesDir,
            $this->seedsDir
        ]);

        $this->spawn_create(
            $this->migrationsDir . '/' . date('Y_m_d_His') . '_create_' . strtolower(str_plural($this->modelName)) . '_table.php',
            $this->getStubPath('Database/Migration.stub')
        );
        $this->spawn_create(
            $this->factoriesDir . '/' . $this->modelName . 'Factory.php',
            $this->getStubPath('Database/Factory.stub')
        );
        $this->spawn_create(
            $this->seedsDir . '/' . str_plural($this->modelName) . 'TableSeeder.php',
            $this->getStubPath('Database/Seed.stub')
        );

        $pattern = '/(public function run\(\)\s*\{[^\}]*)/';
        $this->spawn_insert(
            database_path('seeds/DatabaseSeeder.php'),
            $this->getStubPath('Database/SeedRegistration.stub'),
            $pattern
        );

        if ($this->confirm('Migrate?')) {
            $this->runProcess('php artisan migrate');
        }

        $this->info('...Created and registered migration, factory and seed');
    }

}