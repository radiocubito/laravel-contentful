<?php

namespace Radiocubito\Wordful\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class EnsureUserIsAuthorized
{
    public function handle($request, Closure $next, $guard = null)
    {
        $allowed = app()->environment('local')
            || Gate::allows('viewWordful', [$request->user()]);

        abort_unless($allowed, 403);

        return $next($request);
    }
}
