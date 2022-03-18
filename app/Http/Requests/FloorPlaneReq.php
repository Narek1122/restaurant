<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FloorPlaneReq extends FormRequest
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
        return [
            'hall_name' => 'required',
            'img' => 'nullable|image',
            'table_x'=> 'required',
            'table_y'=> 'required',
            'data_json'=> 'required',
            'description'=> 'nullable'
        ];
    }
}
