<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
                'title' => 'required|min:10|max:200|unique:pages',
                'content' => 'required|min:50',
                'type' => 'required|max:10',
            ];
        }else if ($this->getMethod() == 'PUT'){
            $rule = [
                'title'         => 'required|min:10|max:200',
                'content'       => 'required|min:50',
                'sub_content'   => 'required|min:10|max:200',
                'status'        => 'required',
            ];
            return $rule;
        }
    }
}
