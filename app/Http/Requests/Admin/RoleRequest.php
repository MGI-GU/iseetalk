<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if($this->getMethod() == 'POST'){
            return [
                'name' => 'required|unique:roles',
            ];
        }else if ($this->getMethod() == 'PUT'){
            $rule = [
                'name' => 'required|unique:roles,name,'. $this->route()->roles->id,
            ];
            return $rule;
        }
    }
}
