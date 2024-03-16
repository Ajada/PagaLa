<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\MultiTenant;

class TenantScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(! $request->header('__company_id') || is_null($request->header('__company_id')))
            return response()->json(['error' => true], 422);

        $companyId = $request->header('__company_id');

        config(['app.company_id' => $companyId]);

        return $next($request);
    }
}
