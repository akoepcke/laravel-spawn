<?php

namespace AKoepcke\LaravelSpawn\Commands;

use Illuminate\Console\Command;
use AKoepcke\LaravelSpawn\Traits\SpawnFunctionsTrait;

class SpawnRoute extends Command
{
    use SpawnFunctionsTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spawn:route {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spawn basic CRUD routes';

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

        $this->spawn_append(
            base_path('routes/web.php'),
            $this->getStubPath('routes/Web.stub')
        );

        $this->info('...Registered routes and route model binding');
    }
}
