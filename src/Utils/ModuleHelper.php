<?php

namespace Swan\ArtisanModule\Utils;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ModuleHelper
{
    public static function getModules(): Collection
    {
        $directories = self::getModuleInfos();
        return collect(array_keys($directories));
    }
    
    public static function exists(string $module): bool
    {
        return self::getModules()->contains($module);
    }
    
    public static function getModulePath(string $module): string
    {
        return self::getModuleInfos()[$module]->path;
    }

    public static function getModuleNamespace($module): string
    {
        return self::getModuleInfos()[$module]['namespace'];
    }

    public static function getBaseNameSpace(): string
    {
        $content = file_get_contents(app()->basePath() . '/composer.json');
        $content = json_decode($content, true);

        $autoLoad = $content['autoload']['psr-4'];
        return array_search('src/', $autoLoad);
    }

    public static function getModuleInfos(): array
    {
        $dir = app()->basePath() . '/src';
        $directories = glob($dir . '/*' , GLOB_ONLYDIR);
        $baseNamespace = self::getBaseNameSpace();
        $paths = [];
        foreach ($directories as $value) {
            $namespace = Str::replace('/', '\\', Str::replace($dir, $baseNamespace, $value));
            $name = Str::afterLast($value, '/');
            $paths[$name] = [
                'name' => $name,
                'namespace' => $namespace,
                'path' => $value,
            ];
        }

        return $paths;
    }
}
