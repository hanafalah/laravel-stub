<?php

namespace Zahzah\LaravelStub\Providers;

use Illuminate\Support\ServiceProvider;
use Zahzah\LaravelStub\Commands;

class CommandServiceProvider extends ServiceProvider
{
    protected $__commands = [
        Commands\InstallMakeCommand::class
    ];

    /**
     * Register the command.
     *
     * @return void
     */
    public function register(){
        $this->commands(config('laravel-stub.commands',$this->__commands));
    }

    public function provides(){
        return $this->__commands;
    }
}
