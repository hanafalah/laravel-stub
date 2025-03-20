<?php

namespace Zahzah\LaravelStub\Contracts;

interface Stub {
    public function __construct($path='', array $replaces = []);
    public function init($path='', array $replaces = []);
}