<?php

namespace Swan\ArtisanModule\Commands;

use Illuminate\Foundation\Console\RouteListCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Swan\ArtisanModule\Utils\ModuleHelper;
use Symfony\Component\Console\Input\InputOption;

class ModuleRouteListCommand extends RouteListCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:route-list';

    protected function filterRoute(array $route)
    {
        if($this->option('module')) {
            $module = Str::ucfirst($this->option('module'));
            if (!ModuleHelper::exists($module)) {
                $this->error("Specified module $module does not exist, available modules are:");
                $this->call('module:list', ['--simple' => true]);
                exit;
            }
            $namespace = ModuleHelper::getBaseNameSpace();
            if (!Str::startsWith($route['action'],  $namespace . $module))
                return;
        }

        return parent::filterRoute($route);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge([
            'module' => ['module', null, InputOption::VALUE_REQUIRED, 'The name of the module']
        ], parent::getOptions());
    }
}
