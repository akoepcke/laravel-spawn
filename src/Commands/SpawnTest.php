<?php

namespace AKoepcke\LaravelSpawn\Commands;

use AKoepcke\LaravelSpawn\Traits\SpawnFunctionsTrait;
use Illuminate\Console\Command;

class SpawnTest extends Command
{
    use SpawnFunctionsTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spawn:test {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spawn default tests';

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
        $this->touchDirectory($this->featureTestsDir);
        $dir = $this->featureTestsDir . '/' . strtolower(str_plural($this->modelName));
        $this->touchDirectory($dir);

        $this->spawn_create(
            $dir . '/' . $this->modelName . 'ControllerCreateTest.php',
            $this->getStubPath('tests/ControllerCreateTest.stub')
        );
        $this->spawn_create(
            $dir . '/' . $this->modelName . 'ControllerDestroyTest.php',
            $this->getStubPath('tests/ControllerDestroyTest.stub')
        );
        $this->spawn_create(
            $dir . '/' . $this->modelName . 'ControllerEditTest.php',
            $this->getStubPath('tests/ControllerEditTest.stub')
        );
        $this->spawn_create(
            $dir . '/' . $this->modelName . 'ControllerIndexTest.php',
            $this->getStubPath('tests/ControllerIndexTest.stub')
        );
        $this->spawn_create(
            $dir . '/' . $this->modelName . 'ControllerStoreTest.php',
            $this->getStubPath('tests/ControllerStoreTest.stub')
        );
        $this->spawn_create(
            $dir . '/' . $this->modelName . 'ControllerUpdateTest.php',
            $this->getStubPath('tests/ControllerUpdateTest.stub')
        );
        $this->spawn_create(
            $dir . '/Trashed' . $this->modelName . 'ControllerDestroyTest.php',
            $this->getStubPath('tests/TrashedControllerDestroyTest.stub')
        );
        $this->spawn_create(
            $dir . '/Trashed' . $this->modelName . 'ControllerIndexTest.php',
            $this->getStubPath('tests/TrashedControllerIndexTest.stub')
        );
        $this->spawn_create(
            $dir . '/Trashed' . $this->modelName . 'ControllerRestoreTest.php',
            $this->getStubPath('tests/TrashedControllerRestoreTest.stub')
        );

        $this->info('...Created the tests');
    }

}