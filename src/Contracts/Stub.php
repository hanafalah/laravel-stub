<?php

namespace Hanafalah\LaravelStub\Contracts;

interface Stub
{
    public function __construct($path = '', array $replaces = []);
    public function init($path = '', array $replaces = []);
}
