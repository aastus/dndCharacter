<?php

namespace App\Http\Controllers;


use App\Api\v1\Http\Controllers\BaseController;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function __invoke($locale)
    {
        Session::put('locale', $locale);
        $referer = redirect()->back()->getTargetUrl();
        $parse_url = parse_url($referer, PHP_URL_PATH);
        $segments = explode('/', $parse_url);

        if (isset($segments[1]) && in_array($segments[1], config('app.locales'))) {
            unset($segments[1]);
        }

        if (LocaleMiddleware::$mainLanguage !== $locale) {
            array_splice($segments, 1, 0, $locale);
        }

        $url = str_replace('/public', '', Request::root())
            . implode("/", $segments);
        if (parse_url($referer, PHP_URL_QUERY)) {
            $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
        }

        return redirect($url);
    }
}
