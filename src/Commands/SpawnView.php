<?php

namespace AKoepcke\LaravelSpawn\Commands;

use Illuminate\Console\Command;
use AKoepcke\LaravelSpawn\Traits\SpawnFunctionsTrait;

class SpawnView extends Command
{
    use SpawnFunctionsTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spawn:view {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spawn a model\'s CRUD views';

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
            $this->viewsDir,
            $this->viewsDir.'/'.strtolower(str_plural($this->modelName)),
            $this->viewsDir.'/trashed'.str_plural($this->modelName),
        ]);

        $this->spawn_create(
            $this->viewsDir.'/'.strtolower(str_plural($this->modelName)).'/create.blade.php',
            $this->getStubPath('views/Model/Create.stub')
        );
        $this->spawn_create(
            $this->viewsDir.'/'.strtolower(str_plural($this->modelName)).'/edit.blade.php',
            $this->getStubPath('views/Model/Edit.stub')
        );
        $this->spawn_create(
            $this->viewsDir.'/'.strtolower(str_plural($this->modelName)).'/_formfields.blade.php',
            $this->getStubPath('views/Model/_formfields.stub')
        );
        $this->spawn_create(
            $this->viewsDir.'/'.strtolower(str_plural($this->modelName)).'/index.blade.php',
            $this->getStubPath('views/Model/Index.stub')
        );
        $this->spawn_create(
            $this->viewsDir.'/trashed'.str_plural($this->modelName).'/index.blade.php',
            $this->getStubPath('views/trashedModel/Index.stub')
        );

        $this->info('...Created the views');
    }
}
