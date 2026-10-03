<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Middleware role fleksibel, bisa dipakai untuk 1 atau beberapa role sekaligus.
     * Contoh pemakaian di route:
     *   Route::middleware(['auth', 'role:admin'])->group(...);
     *   Route::middleware(['auth', 'role:admin,editor'])->group(...);
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, $roles, true)) {
            abort(403, 'Kamu tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
