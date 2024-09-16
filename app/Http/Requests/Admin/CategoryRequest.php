<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'name' => 'required|unique:category',
            ];
        }else if ($this->getMethod() == 'PUT'){
            $rule = [
                'name' => 'required|unique:category,name,'. $this->route()->category->id,
                
            ];
            return $rule;
        }
    }
}
