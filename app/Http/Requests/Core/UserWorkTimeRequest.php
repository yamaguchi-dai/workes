<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/05
 *
 */

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

abstract class UserWorkTimeRequest extends FormRequest {

    abstract function setRules(): array;


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        $rules = array_merge([

        ], $this->setRules());

        return $this->setRules();
    }

}
