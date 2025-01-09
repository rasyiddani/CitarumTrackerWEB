<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    protected $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $idToken = $request->session()->get('firebase_token');

        if ($idToken) {
            try {
                // Attempt to verify the ID token
                $verifiedIdToken = $this->auth->verifyIdToken($idToken);
                $request->attributes->set('firebase_user', $verifiedIdToken->claims()->get('sub'));

                return redirect()->to('/');
            } catch (FailedToVerifyToken $e) {
                // Check if the token is expired
                if (strpos($e->getMessage(), 'expired') !== false) {
                    Log::warning('Firebase token expired', ['error' => $e->getMessage()]);
                    return $next($request);
                }

                // For other token verification errors
                Log::error('Firebase token verification failed', ['error' => $e->getMessage()]);
                return $next($request);
            }
        }

        return $next($request);
    }
}
