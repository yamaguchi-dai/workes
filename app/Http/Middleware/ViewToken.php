<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/09
 *
 */

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;

class ViewToken {
    public function __construct(Factory $viewFactory) {
        $this->viewFactory = $viewFactory;
    }

    public function handle($request, \Closure $next) {
        $this->viewFactory->share('api_token', Auth::user()->userToken()['token']);

        return $next($request);
    }
}
