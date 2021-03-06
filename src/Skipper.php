<?php

namespace Anla\Skipper;

use Illuminate\Support\Facades\Storage;
use Anla\Skipper\Models\Setting;

class Skipper
{
    /**
     *  Singleton Skipper Class.
     */
    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     *  End Singleton operators.
     *
     * @param $key
     * @param null $default
     *
     * @return null
     */
    public static function setting($key, $default = null)
    {
        $setting = Setting::where('key', '=', $key)->first();
        if (isset($setting->id)) {
            return $setting->value;
        }

        return $default;
    }

    public static function image($file, $default = '')
    {
        if (!empty($file) && Storage::exists(config('skipper.storage.subfolder').$file)) {
            return Storage::url(config('skipper.storage.subfolder').$file);
        }

        return $default;
    }
}
