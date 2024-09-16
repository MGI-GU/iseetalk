<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if (!app()->runningInConsole() && $user) {
            $roles = Role::with('permission')->get();

            foreach ($roles as $role) {
                foreach ($role->permission as $permissions) {
                    $permissionsArray[$permissions->name][] = $role->id;
                }
            }

            foreach ($permissionsArray as $title => $roles) {
                Gate::define($title, function (\App\User $user) use ($roles) {
                    foreach($user->roleusers as $user_role){
                        return count(array_intersect(array($user_role->role_id), $roles)) > 0;
                    }
                });
            }
        }
        return $next($request);
    }
}
