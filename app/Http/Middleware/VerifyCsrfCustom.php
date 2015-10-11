<?php namespace App\Http\Middleware;

use Illuminate\Session\TokenMismatchException;

class VerifyCsrfCustom extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken
{
    /**
     * Routes we want to exclude.
     *
     * @var array
     */
    protected $routes = [
        'auth/register',
        'auth/login',
        'auth/login/facebook',
        'auth/email/verify',
        'auth/apns/*',
        'queue/receive',
        'notification/*',
        'spruce/*',
        'shop/create',
        'user/*',
        'users',
        'users/search',
        'outfit/*',
        'outfits',
        'outfits/ids',
        'outfits/search',
        'piece/*',
        'pieces',
        'pieces/ids',
        'pieces/search',
        'upload/*',
        'delivery/options',
        'delivery/option/*',
        'shipping/address/*',
        'cart/*',
        'cart/item/*',
        'billing/*',
        'order/*',
        'orders/*',
        'refund/*',
        'update/profile',
        'update/password',
        'mail/feedback',
        'mail/orders',
        'dashboard/report',
        'dashboard/onboarding',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, \Closure $next)
    {
        if ($this->isReading($request)
            || $this->excludedRoutes($request)
            || $this->tokensMatch($request))
        {
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
    }

    /**
     * This will return a bool value based on route checking.

     * @param  Request $request
     * @return boolean
     */
    protected function excludedRoutes($request)
    {
        foreach($this->routes as $route)
            if ($request->is($route))
                return true;

        return false;
    }

}
