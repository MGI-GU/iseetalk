<?php

namespace App\Http\Requests\Studio;

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
        $rule = [];
        if ($this->getMethod() == 'PUT'){
            if($this->has('type') && $this->get('type')=='publish'){

            }else{
                $rule = [
                    'name'          => 'required',
                    'description'   => 'required',
                ];
            }
        }else{
            $rule = [
                'name' => 'required|max:200',
                'description' => 'required',
            ];
        }
        return $rule;
    }
}
