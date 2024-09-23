<?php

if (! function_exists('custom_asset')) {
    function custom_asset($path)
    {
        return rtrim(config('app.url'), '/') . '/' . ltrim($path, '/');
    }
}
