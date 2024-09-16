<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $rule = [
            'web_subscription'      => 'required',
            'web_recommendation'    => 'required',
            'web_channel'           => 'required',
            'web_all_comment'       => 'required',
            'web_my_comment_reply'  => 'required',
            'email_permission'      => 'required',
            'email_subscription'    => 'required',
            'email_product'         => 'required',
            'email_channel'         => 'required',
        ];
        return $rule;
    }
}
