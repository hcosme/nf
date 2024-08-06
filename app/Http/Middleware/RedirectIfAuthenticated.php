<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        
        date_default_timezone_set('America/Sao_Paulo');
        $data_hora = date('d/m/Y H:i:s');
        $produtoEditando = DB::table('users')
            ->where('email', $request->email)
            ->update(
            [
                'ultimo_login' => $data_hora
            ]
        );

        if ($request->email != '') {

            $insert = DB::table('logs')->insert([
                'email'     =>  $request->email,
                'portal'    => 'indicadores',
                'tipo'      => 'login'
            ]);
        }

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
