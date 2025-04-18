<?php

use Hanafalah\LaravelStub\Commands\InstallMakeCommand;

return [
    'stub' => [
        'open_separator'  => '{{',
        'close_separator' => '}}',
        'path'            => base_path('stubs'),
    ],
    'commands'        => [
        InstallMakeCommand::class
    ],
];
