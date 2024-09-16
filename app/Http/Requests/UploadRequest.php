<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
        if($this->get('type') == 'audio' || $this->get('type') == 'audio_file'){
            $rule = [
                'file' => 'mimes:mpeg,mp3,m4a,wav'
            ];
        }else if($this->get('type') == 'attachment'){
            $rule = [
                'file' => 'mimes:jpeg,png,pdf,pptx,ppt'
            ];
        }else if($this->get('type') == 'source'){
            $rule = [
                'file' => 'mimes:jpeg,png,pdf,pptx,ppt,mpeg'
            ];
        }else{
            $rule = [
                'file' => 'mimes:jpeg,png'
            ];
        }
        return $rule;
    }
}
