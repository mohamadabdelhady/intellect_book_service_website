<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class subscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $days=now()->diffInDays(\Carbon\Carbon::parse(\auth()->user()->created_at));

        if ($days>=30&&auth()->user()->chosen_plan==null)
        {
//            $times_up=true;
            return response()->view('pages.choose_plan');
        }
        return $next($request);
    }
}
