<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if (!function_exists('uuid')) {
    function uuid(): string
    {
        return (string) \Str::uuid();
    }
}

if (!function_exists('carbon')) {
    function carbon(...$args)
    {
        return new Carbon(...$args);
    }
}

if (!function_exists('slug')) {
    function slug(string $string, string $separator = '-')
    {
        return Str::slug($string, $separator);
    }
}

if (!function_exists('ensure_date_format')) {
    function ensure_date_format($date)
    {
        $date = strtotime($date);

        if (!$date) {
            return null;
        }

        return carbon($date)->format('m/d/Y');
    }
}

if (!function_exists('str_plural')) {
    function str_plural($singular, $count)
    {
        return Str::plural($singular, $count);
    }
}

if (!function_exists('file_last_modified')) {
    function file_last_modified($path)
    {
        $unixTime = Storage::disk('spaces')->lastModified($path);

        return carbon($unixTime)->diffForHumans();
    }
}