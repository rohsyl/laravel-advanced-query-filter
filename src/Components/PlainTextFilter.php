<?php

namespace rohsyl\LaravelAdvancedQueryFilter\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use rohsyl\LaravelAdvancedQueryFilter\AdvancedQueryFilter;
use rohsyl\LaravelAdvancedQueryFilter\Filters;

class PlainTextFilter extends FilterComponent
{

    public $helper;
    public $dark;

    public function __construct($helper = null, $dark = false)
    {
        $this->helper = $helper;
        $this->dark = $dark;
    }


    public static function boot()
    {
        Blade::component('aqf-plain', self::class);
    }

    public function render()
    {
        return view('laravel_aqf::_plain');
    }

    public static function filter(AdvancedQueryFilter $aqf, Builder $query)
    {
        $text = self::value();
        if (isset($text) && ! empty($text)) {
            $aqf->call('plain', $query, $text);
        }
    }

    public static function value()
    {
        $text = null;
        if (self::request()->has('plain')) {
            $text = self::request()->input('plain');
        }
        return $text;
    }
}
