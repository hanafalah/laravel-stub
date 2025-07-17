<?php

namespace Hanafalah\LaravelStub\Facades;

use Illuminate\Support\Facades\Facade;
use Hanafalah\LaravelStub\Contracts\Stub as ContractsStub;

class Stub extends Facade
{
   /**
    * Get the registered name of the component.
    *
    * @return string
    */

   protected static function getFacadeAccessor()
   {
      return app()->make(ContractsStub::class);
   }
}
