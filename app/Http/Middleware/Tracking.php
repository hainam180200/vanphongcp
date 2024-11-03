<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\ActivityLog;


class Tracking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $activity = ActivityLog::where('ip',$request->getClientIp())
                    ->where('created_at','<=', now()->startOfWeek())
                    ->where('method', 'ACCESS')
                    ->where('prefix', 'frontend');
        if ($activity){
            $activity = $activity->delete();
        }

        ActivityLog::create([
            'prefix' => 'frontend',
            'method'=> 'ACCESS',
            'url'=> \Request::fullUrl(),
            'description'=> 'Truy cập vào web',
            'ip'=>$request->getClientIp(),
            'user_agent'=>isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'No User Agent'
        ]);


        return $next($request);
    }
}
