<?php

if (! function_exists('stub_path')) {
    /**
     * Get the path to the stubs folder.
     *
     * @param  string  $path
     * @return string
     */
    function stub_path($path = ''){
        return base_path('stubs/'.$path);
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
        // preg_replace_callback('/\b(\w+)/', function ($matches) {
        //     return ucfirst($matches[1]);
        //     }, $name);
        // return preg_replace('/[^A-Za-z0-9]/', '', $name);
    }
}