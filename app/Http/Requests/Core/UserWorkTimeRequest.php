<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/05
 *
 */

namespace App\Http\Requests\Core;

use App\Models\UserToken;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

abstract class UserWorkTimeRequest extends FormRequest {

    abstract function setRules(): array;

    /**
     * ApiTokenを用いてユーザー認証
     * @return bool
     */
    function authorize() {
        /** @var UserToken $userToken */
        $userToken = UserToken::where('token', $this->getApiToken())->first();
        //tokenが存在しなければ
        if (!$userToken) {
            Log::error('存在しないTokenです');
            return FALSE;
        }
        Log::info('Tokenチェックが完了しました。');
        //tokenからユーザーを特定してログイン
        Auth::login($userToken->user());
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        $rules = array_merge([
            'api_token' => ['required']
        ], $this->setRules());

        return $this->setRules();
    }


    /**
     * token取得
     * @return mixed
     */
    function getApiToken() {
        return $this->get('api_token');
    }
}
