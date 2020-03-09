<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/09
 *
 */

namespace App\Http\Middleware;


use App\Models\UserToken;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiAuth {

    /**
     * API認証　tokenからユーザーを認証
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next) {
        /** @var UserToken $userToken */
        $userToken = UserToken::where('token', $request->get('api_token'))->first();
        //tokenが存在しなければ
        if (!$userToken) {
            Log::error('存在しないTokenです');
            throw new \Exception('api-tokenが設定されていません');
        }
        Log::info('Tokenチェックが完了しました。');
        //tokenからユーザーを特定してログイン
        Auth::login($userToken->user());
        return $next($request);
    }
}
