<?php

if (!function_exists('custom_asset')) {
    function custom_asset($path)
    {
        if (app()->environment('local')) {
            return asset($path);
        } else {
            return secure_asset($path);
        }
    }
}
