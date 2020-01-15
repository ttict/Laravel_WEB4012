<?php
namespace App\Http\Middleware;
/*use Illuminate\Support\Facades\Auth;*/
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
class adminLogin
{
    public function handle($request, Closure $next)
    {
        $roles = Role::all();
        if (Auth::check()) {
            $user = Auth::user();
            if($roles->count() != 0) {
                    if ($user->roles->first()->name == 'Admin') {
                        return $next($request);
                    }
                    else
                    return redirect('login');
            };

        } else
            return redirect('login');
    }


}
