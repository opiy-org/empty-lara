<?php

namespace App\Http\Middleware;

use App\Helpers\l;
use Closure;

class ProcessJson{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isJson())
        {
            $json_array = $request->json()->all();
            $request->replace($json_array);
        }

        return $next($request);

    }

}