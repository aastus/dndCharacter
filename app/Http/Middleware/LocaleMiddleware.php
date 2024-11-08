<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Request;

class LocaleMiddleware extends Middleware
{

    public static $mainLanguage = 'uk';
    public static $languages = ['uk', 'en'];

    public static function getLocale()
    {
        $uri = Request::path();

        $segmentsURI = explode('/', $uri);


        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
            if ($segmentsURI[0] != self::$mainLanguage) {
                return $segmentsURI[0];
            }
        }
        return null;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();

        if ($locale) {
            App::setLocale($locale);
        } else {
            App::setLocale(self::$mainLanguage);
        }

        return $next($request);
    }
}
