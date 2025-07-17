<?php

if (! function_exists('stub_path')) {
    /**
     * Get the path to the stubs folder.
     *
     * @param  string  $path
     * @return string
     */
    function stub_path($path = ''){
        return config('laravel-stub.stub.path').$path;
    }
}

if (! function_exists('to_studly')) {
    /**
     * Build a valid class name from a string.
     *
     * Replaces non-alphanumeric characters with an empty string, and
     * capitalizes the first letter of each word.
     *
     * @param string $name
     *
     * @return string
     */
    function to_studly($name) {
        return \Illuminate\Support\Str::studly($name);
    }
}