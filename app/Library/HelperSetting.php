<?php


if (! function_exists('setting')) {

    function setting($key, $default = null)
    {

        if (is_null($key)) {
            return new \App\Models\Setting();
        }

        if (is_array($key)) {
            return \App\Models\Setting::set($key[0], $key[1]);
        }

        $value = \App\Models\Setting::get($key);

        return is_null($value) ? value($default) : $value;
    }
}
if (! function_exists('widget')) {

    function widget($view_name, $time_cache=null)
    {   
        if($time_cache==null){
            return $viewRender = Cache::rememberForever('cache_'.$view_name, function () use($view_name){
                return $aCache =  view($view_name)->render();
            });
        }
        else{
            return $viewRender = Cache::remember('cache_'.$view_name, $time_cache, function () use($view_name){
                return $aCache =  view($view_name)->render();
            });
        }
    }
}
