<?php

use Hanafalah\LaravelStub\Commands\InstallMakeCommand;

return [
    'stub' => [
        'open_separator'  => '{{',
        'close_separator' => '}}',
        'path'            => stub_path(),
    ],
    'commands'        => [
        InstallMakeCommand::class
    ],
];
