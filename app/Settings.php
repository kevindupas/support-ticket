<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'name',
        'value',
    ];

    public function settings($key)
    {
        static $settings;

        if(is_null($settings))
        {
            $settings = Cache::remember(
                'settings', 24 * 60, function (){
                return Settings::all()->pluck('value', 'key');
            }
            );
        }

        return (is_array($key)) ? array_only($settings, $key) : $settings[$key];
    }
}
