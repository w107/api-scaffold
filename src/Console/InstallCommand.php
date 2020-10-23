<?php

namespace Inn20\ApiScaffold\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-scaffold:install {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the api-scaffold package';

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
        $force = $this->option('force');

        $this->publishByProvider(\Inn20\ApiScaffold\ApiServiceProvider::class, $force);
        $this->publishByProvider(\Tymon\JWTAuth\Providers\LaravelServiceProvider::class, $force);
        $this->call('jwt:secret');
    }

    protected function publishByProvider($provider, $force)
    {
        $options = ['--provider' => $provider];
        if ($force == true) {
            $options['--force'] = true;
        }
        $this->call('vendor:publish', $options);
    }

}
