<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        // dd($this->route()->category->id);
        $rule = [];
        if($this->has('name') || $this->has('email') || $this->has('phone')){
            $rule = [
                'name'              => 'required|regex:/^[\pL\s\-]+$/u|max:30',
                'email'             => 'required|email',
                'phone'             => 'required|digits_between:7,15',
            ];
        }else{
            $rule = [
                'personal_status'   => 'string|max:100',
                'sex'               => 'string|max:10',
                'birthday'          => 'date',
                'location'          => 'string|max:100',
            ];
        }
        if($this->get('password') != null || $this->get('password_confirmation') != null){
            $rule['password'] = 'required|alpha_num|min:6|max:16|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/';
        }
        return $rule;
    }
}
