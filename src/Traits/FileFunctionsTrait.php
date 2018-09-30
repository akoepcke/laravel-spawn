<?php

namespace AKoepcke\LaravelSpawn\Traits;

use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

trait FileFunctionsTrait
{
    /**
     * Create directory if not exists.
     *
     * @param $paths
     */
    protected function touchDirectory($paths)
    {
        $paths = is_array($paths) ? $paths : func_get_args($paths);

        foreach ($paths as $path) {
            if (! File::isDirectory($path)) {
                File::makeDirectory($path, 0775, true);
            }
        }
    }

    protected function insert_before($pattern, $replacement, $file)
    {
        return preg_replace($pattern, $replacement.'$1', $file);
    }

    protected function insert_replace($pattern, $replacement, $file)
    {
        return preg_replace($pattern, $replacement, $file);
    }

    protected function insert_after($pattern, $replacement, $file)
    {
        return preg_replace($pattern, '$1'.$replacement, $file);
    }

    protected function getFileContent($path)
    {
        if (File::exists($path)) {
            return File::get($path);
        }
    }

    protected function fixCodestyle($path)
    {
        if (File::exists($path)) {
            $this->runProcess('php-cs-fixer fix '.$path);
        }
    }

    protected function runProcess($command)
    {
        $process = new Process($command);
        $process->run(function ($type, $buffer) {
            ($buffer == 'Readi' || "\n") ?: $this->line($buffer);
        });
    }
}
