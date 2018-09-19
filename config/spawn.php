<?php

return [
    /*
     * path and namespace to where models will be placed.
     * Default Laravel  is '' and 'App',
     * but I'd like to keep things organized by placing them in a separate folder
     */
    'models_dir'        => 'Models',
    'models_namespace'  => 'App\Models',

    /*
     * path and namespace to where controllers will be placed.
     * Default Laravel  is 'Http/Controllers' and 'App\Http\Controllers'
     */
    'controllers_dir'        => 'Http/Controllers',
    'controllers_namespace'  => 'App\Http\Controllers',

    /*
     * path and namespace to where policies will be placed.
     * Default Laravel  is 'Policies' and 'App\Policies'
     */
    'policies_dir'          => 'Policies',
    'policies_namespace'    => 'App\Policies',

    /*
     * path within resource folder to where admin views will be placed.
     * Default Laravel  is 'views'
     */
    'views_dir'             => 'views',

    /*
     * path within database folder to where migrations will be placed.
     * Default Laravel  is 'migrations'
     */
    'migrations_dir'        => 'migrations',

    /*
     * path within database folder to where factories will be placed.
     * Default Laravel  is 'migrations'
     */
    'factories_dir'         => 'factories',

    /*
     * path within database folder to where seeds will be placed.
     * Default Laravel  is 'seeds'
     */
    'seeds_dir'             => 'seeds',

    /*
     * path and namespace to where traits will be placed.
     * Sensible default is 'Traits' and 'App\Traits'
     */
    'traits_dir'          => 'Traits',
    'traits_namespace'    => 'App\Traits',

    /*
     * path and namespace to where feature tests will be placed.
     * Default Laravel is 'tests/Feature' and 'Tests\Feature'
     */
    'featureTests_dir'          => 'tests/Feature',
    'featureTests_namespace'    => 'Tests\Feature',
];