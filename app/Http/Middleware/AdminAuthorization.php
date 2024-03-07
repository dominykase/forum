<?php

namespace App\Http\Middleware;

use App\Modules\Users\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthorization
{
    public function handle(Request $request, Closure $next): Response
    {
        if (request()->user()->role->name !== RoleEnum::ADMIN->value) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
