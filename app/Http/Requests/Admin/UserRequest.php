<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->get('password') != null || $this->get('password_confirmation') != null){
            $rule = [
                'password'          => 'required|alpha_num|min:6|max:16|confirmed',
            ];
        }else{
            $rule = [
                'name'              => 'required|regex:/^[\pL\s\-]+$/u|max:30',
                'email'             => 'required|email',
                'phone'             => 'required|digits_between:7,15',
                'type'              => 'required|max:50',
                'sex'               => 'string|max:20',
                'status'            => 'string|max:20',
            ];
        }
        return $rule;
    }
}
