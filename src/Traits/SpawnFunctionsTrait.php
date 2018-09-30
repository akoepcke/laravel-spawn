<?php

namespace AKoepcke\LaravelSpawn\Traits;

use Illuminate\Support\Facades\File;

trait SpawnFunctionsTrait
{
    use FileFunctionsTrait;

    /**
     * The name of the model.
     *
     * @var string
     */
    private $modelName;

    /**
     * The paths to the directories.
     *
     * @var string
     */
    private $modelsDir;
    private $controllersDir;
    private $policiesDir;
    private $viewsDir;
    private $migrationsDir;
    private $factoriesDir;
    private $seedsDir;
    private $traitsDir;
    private $bladeIncludesDir;
    private $featureTestsDir;

    /**
     * init paths from config.
     */
    protected function initVars()
    {
        $this->modelName = ucfirst($this->argument('name'));
    }

    /**
     * init paths from config.
     */
    protected function initDirs()
    {
        $this->modelsDir = app_path(config('spawn.models_dir'));
        $this->controllersDir = app_path(config('spawn.controllers_dir'));
        $this->policiesDir = app_path(config('spawn.policies_dir'));
        $this->viewsDir = resource_path(config('spawn.views_dir'));
        $this->migrationsDir = database_path(config('spawn.migrations_dir'));
        $this->factoriesDir = database_path(config('spawn.factories_dir'));
        $this->seedsDir = database_path(config('spawn.seeds_dir'));
        $this->traitsDir = app_path(config('spawn.traits_dir'));
        $this->bladeIncludesDir = resource_path(config('spawn.bladeIncludes_dir'));
        $this->featureTestsDir = base_path(config('spawn.featureTests_dir'));
    }

    /**
     * Create a file from stub.
     *
     * @param $filepath
     * @param $stubname
     * @param bool $withModel
     */
    protected function spawn_create($filepath, $stubname, $withModel = true)
    {
        $template = $this->getTemplate($stubname, $withModel);
        File::put($filepath, $template);
        $this->fixCodestyle($filepath);
    }

    /**
     * Append stub to file.
     *
     * @param $filepath
     * @param $stubname
     * @param bool $withModel
     */
    protected function spawn_append($filepath, $stubname, $withModel = true)
    {
        $template = $this->getTemplate($stubname, $withModel);
        File::append($filepath, $template);
        $this->fixCodestyle($filepath);
    }

    /**
     * preg_replace($pattern, $replacement, $file)
     * Durchsucht $file nach $pattern und ersetzt sie mit $replacement = $pattern.$stub.
     *
     * @param $filepath
     * @param $stubname
     * @param $searchpattern
     * @param string $position
     */
    protected function spawn_insert($filepath, $stubname, $searchpattern, $position = 'after')
    {
        $file = file_get_contents($filepath);
        $template = $this->getTemplate($stubname);

        switch ($position) {
            case 'before':
                $content = $this->insert_before($searchpattern, $template, $file);
                break;
            case 'instead':
                $content = $this->insert_replace($searchpattern, $template, $file);
                break;
            default:
                $content = $this->insert_after($searchpattern, $template, $file);
        }
        File::put($filepath, $content);
        $this->fixCodestyle($filepath);
    }

    /**
     * Get either published or default stub.
     *
     * @param $filename
     * @return mixed
     */
    protected function getStubPath($filename)
    {
        if (File::exists(resource_path('stubs/'.$filename))) {
            return resource_path('stubs/'.$filename);
        }

        return base_path('vendor/akoepcke/laravel-spawn/resources/stubs/'.$filename);
    }

    /**
     * replaces placeholders in stub.
     *
     * @param $stubname
     * @param bool $withModel
     * @return mixed
     */
    protected function getTemplate($stubname, $withModel = true)
    {
        $template = $this->getFileContent($stubname);

        $template = $this->replaceNamespaces($template);
        if ($withModel) {
            $template = $this->replaceObjects($template);
        }

        return $template;
    }

    protected function replaceObjects($content)
    {
        $content = str_replace(
            [
                '{{modelName}}',
                '{{modelNameLowerCase}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $this->modelName,
                strtolower($this->modelName),
                str_plural($this->modelName),
                strtolower(str_plural($this->modelName)),
            ],
            $content
        );

        return $content;
    }

    protected function replaceNamespaces($content)
    {
        $content = str_replace(
            [
                '{{modelNamespace}}',
                '{{controllerNamespace}}',
                '{{policyNamespace}}',
                '{{traitsNamespace}}',
                '{{featureTestsNamespace}}',
            ],
            [
                config('spawn.models_namespace'),
                config('spawn.controllers_namespace'),
                config('spawn.policies_namespace'),
                config('spawn.traits_namespace'),
                config('spawn.featureTests_namespace'),
            ],
            $content
        );

        return $content;
    }
}
