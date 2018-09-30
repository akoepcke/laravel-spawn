<?php

namespace AKoepcke\LaravelSpawn\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use AKoepcke\LaravelSpawn\Traits\SpawnFunctionsTrait;

class SpawnRole extends Command
{
    use SpawnFunctionsTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spawn:role {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spawn a role with basic CRUD permissions';

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
        if ($this->confirm('If the role and permissions already exist, they will be overwritten.'.PHP_EOL.'Continue anyways?')) {
            $this->initVars();
            $this->initDirs();
            $rolename = $this->modelName.'Admin';
            $object = strtolower(str_plural($this->modelName));

            $role = Role::firstOrCreate(['name' => $rolename]);
            $role->syncPermissions([
                Permission::firstOrCreate(['name' => 'view '.$object]),
                Permission::firstOrCreate(['name' => 'create '.$object]),
                Permission::firstOrCreate(['name' => 'update '.$object]),
                Permission::firstOrCreate(['name' => 'delete '.$object]),
            ]);

            $this->info('......Created and registered the role and permissions');
        } else {
            $this->info('...Skipped');
        }
    }
}
