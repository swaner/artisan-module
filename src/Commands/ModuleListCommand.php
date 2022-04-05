<?php

namespace Swan\ArtisanModule\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Swan\ArtisanModule\Utils\ModuleHelper;
use Symfony\Component\Console\Output\OutputInterface;

class ModuleListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:list {--simple}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modules = ModuleHelper::getModuleInfos();
        if ($this->option('simple')) {
           $this->info(join(', ', array_keys($modules)));
        } else {
            $this->alert(count($modules) . ' modules found');
            $this->table(['Name', 'Namespace', 'Path'], $modules);
        }
    }
}
