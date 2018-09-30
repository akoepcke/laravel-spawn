<?php

namespace AKoepcke\LaravelSpawn\Commands;

use Illuminate\Console\Command;

class SpawnMonster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spawn:monster {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spawn a monster';

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
        $name = ucfirst($this->argument('name'));
        $this->info('Spawn a monster called '.$name, PHP_EOL);

        $this->call('spawn:model', ['name' => $name]);
        $this->call('spawn:controller', ['name' => $name]);
        $this->call('spawn:test', ['name' => $name]);
        $this->call('spawn:policy', ['name' => $name]);
        $this->call('spawn:role', ['name' => $name]);
        $this->call('spawn:view', ['name' => $name]);
        $this->call('spawn:database', ['name' => $name]);
        $this->call('spawn:route', ['name' => $name]);

        $this->info('Good luck!');
    }
}
