<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithoutPenjual
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
            return redirect()->route('dashboard.view');
        } elseif (Auth::check() && Auth::user()->role == 'kasir') {
            return redirect()->route('kasir.pesanan.view');
        } else {
            return $next($request);
        }
        return redirect('');
    }
}
