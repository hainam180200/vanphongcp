<?php

namespace App\Http\Middleware;
use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;


class ActivityLogUser
{


    public function handle(Request $request, Closure $next)
    {
        //ActivityLog::add($request);
        return $next($request);
    }

    public function terminate( $request, $response) {
    }





}
