<?php

namespace Anla\Skipper\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'skipper:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Skipper Admin package';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function getOptions()
    {
        return [
            ['existing', null, InputOption::VALUE_NONE, 'install on existing laravel application', null],
            ['no-dummy-data', null, InputOption::VALUE_NONE, 'install without seeding dummy data', null],
        ];
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (!$this->option('existing')) {
            $this->info('Generating the default authentication scaffolding');
            Artisan::call('make:auth');
        }

        $this->info('Publishing the Skipper assets, database, and config files');
        Artisan::call('vendor:publish', ['--provider' => \Anla\Skipper\SkipperServiceProvider::class]);
        Artisan::call('vendor:publish', ['--provider' => \Intervention\Image\ImageServiceProviderLaravel5::class]);

        $this->info('Migrating the database tables into your application');
        Artisan::call('migrate');

        $this->info('Dumping the autoloaded files and reloading all new files');

        $composer = $this->findComposer();

        $process = new Process($composer.' dump-autoload');
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Seeding data into the database');
        if ($this->option('no-dummy-data')) {
            $process = new Process('php artisan db:seed --class=DataTypesTableSeeder');
            $process->setWorkingDirectory(base_path())->run();
            $process = new Process('php artisan db:seed --class=DataRowsTableSeeder');
            $process->setWorkingDirectory(base_path())->run();
        } else {
            $process = new Process('php artisan db:seed --class=SkipperDatabaseSeeder');
            $process->setWorkingDirectory(base_path())->run();
        }

        $this->info('Adding the storage symlink to your public folder');
        Artisan::call('storage:link');

        $this->info('Successfully installed Skipper! Enjoy :)');
    }
}
