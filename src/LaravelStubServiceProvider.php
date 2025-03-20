<?php

namespace Zahzah\LaravelStub;
use Zahzah\LaravelSupport\Providers\BaseServiceProvider;

class LaravelStubServiceProvider extends BaseServiceProvider
{
    /**
     * Registers the service provider with the application.
     *
     * This method will register the config, namespace, services, and the
     * provider with the application.
     *
     * @return self The current instance of the class.
     */
    public function register(){
        $this->registerMainClass(Stub::class)
             ->registerCommandService(Providers\CommandServiceProvider::class)
             ->registers([
                '*','Services' => function(){
                    $this->binds([
                        Contracts\Stub::class => function(){
                            return Stub::class;
                        },
                    ]);
                }
            ]);
    }

    /**
     * Returns the directory path of this ServiceProvider.
     *
     * @return string
     */
    protected function dir(): string{
        return __DIR__.'/';
    }
}