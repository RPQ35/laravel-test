<?php
// CheckRole.php
namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;

class Checking{
    public function handle(Request $input, Closure $next, string $role)
    {
        if (session('role') !== $role) {
            return redirect('/login')->with('error', 'Akses ditolak');
        }

        return $next($input);
    }
}
