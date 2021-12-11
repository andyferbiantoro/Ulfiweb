<?php

namespace App\Http\Middleware;

use Closure;

class AuditorAuth
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
         $user = \Auth::user();

       //jika bukan admin, maka tetap dihalaman yang terakhir kali diakses.
        if($user->isAuditor()){
            return $next($request);
        }else{
            return redirect()->back();//kembali ke halaan sebelumnya
        }
    }
}
