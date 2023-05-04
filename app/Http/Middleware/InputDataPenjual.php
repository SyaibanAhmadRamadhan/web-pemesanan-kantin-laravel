<?php

namespace App\Http\Middleware;

use App\Models\PenjualModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputDataPenjual
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
        if (Auth::check() && Auth::user()->role == 'penjual') {
            if (PenjualModel::where('id_penjual', Auth::user()->id)->first()) {
                abort(404);
            } else {
                return $next($request);
            }
        } else {
            abort(404);
        }
        return redirect('');
    }
}
