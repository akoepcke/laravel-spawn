<?php

namespace AKoepcke\LaravelSpawn\Commands;

use Illuminate\Console\Command;
use AKoepcke\LaravelSpawn\Traits\SpawnFunctionsTrait;

class SpawnModel extends Command
{
    use SpawnFunctionsTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spawn:model {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spawn a new Eloquent model';

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
        $this->touchDirectory($this->modelsDir);

        $this->spawn_create(
            $this->modelsDir.'/'.$this->modelName.'.php',
            $this->getStubPath('Models/Model.stub')
        );

        $this->info('...Created the model');
    }
}
