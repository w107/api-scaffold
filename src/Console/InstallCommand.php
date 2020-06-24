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
    protected $signature = 'api-scaffold:install';

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
        $this->call('vendor:publish', [
            '--provider' => \Dyg0924\ApiScaffold\ApiServiceProvider::class
        ]);
        $this->call('vendor:publish', [
            '--provider' => \Tymon\JWTAuth\Providers\LaravelServiceProvider::class
        ]);
        $this->call('jwt:secret');
    }

}
