<?php

namespace App\Http\Middleware\Can;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CanOrMineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission, $tableName, $nameRouteParam)
    {
        $query = DB::table($tableName)->where('id', $request->route($nameRouteParam))
            ->where('user_id', $request->user()->id);

        if ($request->user()->can($permission) || $query->exists()) {
            return $next($request);
        }

        throw UnauthorizedException::forPermissions([$permission]);
    }
}
