<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest {


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'user_name' => 'required'
            , 'email' => 'required|unique:users,email'
            , 'password' => 'required'
            , 'confirm_password' => 'required|same:password'
        ];
    }
}
