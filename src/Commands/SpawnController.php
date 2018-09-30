<?php

namespace AKoepcke\LaravelSpawn\Commands;

use Illuminate\Console\Command;
use AKoepcke\LaravelSpawn\Traits\SpawnFunctionsTrait;

class SpawnController extends Command
{
    use SpawnFunctionsTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spawn:controller {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spawn a new ModelController and TrashedModelController';

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
        $this->touchDirectory($this->controllersDir);

        $this->spawn_create(
            $this->controllersDir.'/'.$this->modelName.'Controller.php',
            $this->getStubPath('Controllers/Controller.stub')
        );
        $this->spawn_create(
            $this->controllersDir.'/Trashed'.$this->modelName.'Controller.php',
            $this->getStubPath('Controllers/TrashedController.stub')
        );

        $this->info('...Created the controllers');
    }
}
