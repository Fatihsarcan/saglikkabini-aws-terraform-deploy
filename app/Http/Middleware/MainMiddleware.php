<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Team;
use App\Models\Service;
use App\Models\WorkTime;
use App\Models\MainSetting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = MainSetting::pluck('value', 'key')->toArray();
        $workTimes = WorkTime::all();
        $services = Service::all();

        $teams = Team::where('lang', app()->getLocale())->get();

        view()->share([
            'settings' => $settings,
             'workTimes' => $workTimes,
             'services' => $services,
             'teams' => $teams
            ]);
        return $next($request);
    }
}
