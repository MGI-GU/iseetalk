<?php

namespace App\Http\Requests\Studio;

use Illuminate\Foundation\Http\FormRequest;

class AudioRequest extends FormRequest
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
        if($this->getMethod() == 'POST'){
            $rule = [
                'name'          => 'required|max:200',
                'description'   => 'required',
                'channel'       => 'required',
            ];
        }else if ($this->getMethod() == 'PUT'){
            if($this->has('name') && $this->has('description')){
                $rule = [
                    'name'          => 'required|max:200',
                    'description'   => 'required',
                ];
            }
            if($this->has('allow_comment') && $this->has('channel')){
                $rule = [
                    'channel'       => 'required|not_in:0',
                ];
            }
        }
        return $rule;
    }
}
