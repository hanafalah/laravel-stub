<?php

use Hanafalah\LaravelStub\Commands\InstallMakeCommand;

return [
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas'
    ],
    'stub' => [
        'open_separator'  => '{{',
        'close_separator' => '}}',
        'path'            => base_path('stubs'),
    ],
    'commands'        => [
        InstallMakeCommand::class
    ],
];
