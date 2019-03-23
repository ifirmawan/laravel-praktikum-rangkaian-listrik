<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class MustBeMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Gate::allows('is_mahasiswa'))
        {
            return $next($request);
        }else
        {
             abort(403, 'Anda tidak memiliki cukup hak akses');
//            return redirect()->route('site.index');
        }
    }
}
