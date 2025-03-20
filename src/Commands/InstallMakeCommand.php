<?php

namespace Zahzah\LaravelStub\Commands;

use Zahzah\LaravelSupport\Commands\BaseCommand;

class InstallMakeCommand extends BaseCommand{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stub:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ini digunakan untuk installing awal laravel-stub';

    private $__app_model;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $provider = 'Zahzah\LaravelStub\LaravelStubServiceProvider';

        $this->comment('Installing Laravel Stub...');
        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'config'
        ]);
        $this->info('✔️  Created config/laravel-stub.php');
        $this->comment('zahzah/laravel-stub installed successfully.');
    }

    protected function dir(): string{
        return __DIR__.'/../../';
    }
}