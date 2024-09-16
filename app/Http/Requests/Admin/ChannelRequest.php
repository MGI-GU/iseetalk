<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChannelRequest extends FormRequest
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
        if($this->getMethod() == 'POST'){
            return [
                'name'          => 'required|max:200',
                'description'   => 'required',
            ];
        }else if ($this->getMethod() == 'PUT'){
            if($this->has('name') || $this->has('description')){
                $rule = [
                    'name'          => 'required|max:200',
                    'description'   => 'required',
                ];
            }else{
                $rule = [
                    'language'      => 'required',
                    'description'   => 'required',
                ];
            }
            return $rule;
        }
    }
}
