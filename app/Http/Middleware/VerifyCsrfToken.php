<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '*', // ⚠️ Temporary global exclusion (only for debugging)
    ];

    /**
     * Handle the incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('✅ CSRF middleware is running for path: ' . $request->path());

        return parent::handle($request, $next);
    }
}
