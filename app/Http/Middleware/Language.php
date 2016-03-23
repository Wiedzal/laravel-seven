<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Routing\Middleware;
use App\Extensions\LaravelLocalization;


class Language implements Middleware {

    public function __construct(Application $app, Redirector $redirector, Request $request) {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Make sure current locale exists.
        /*$locale = LaravelLocalization::getCurrentLocale();
        var_dump($request->segments());die;
        //LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), 'profile')

        if (!array_key_exists($locale, $this->app->config->get('app.locales'))) {
            $segments = $request->segments();
            $segments[0] = $this->app->config->get('app.fallback_locale');

            //var_dump($request->segments());
            //var_dump($segments);
            //var_dump(implode('/', $segments));die;
            return $this->redirector->to(implode('/', $segments));
        }

        $this->app->setLocale($locale);*/

        return $next($request);
    }

}