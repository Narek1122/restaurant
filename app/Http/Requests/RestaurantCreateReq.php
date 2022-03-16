<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantCreateReq extends FormRequest
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
            'name' => 'nullable',
            'phone_number' => 'required',
            'desc' => 'nullable',
            'address' => 'nullable',
            'longit' => 'nullable',
            'latit' => 'nullable',
            'logo' => 'nullable',
            'images' => 'nullable',
            '1_start' => 'nullable',
            '1_end' => 'nullable',
            '2_start' => 'nullable',
            '2_end' => 'nullable',
            '3_start' => 'nullable',
            '3_end' => 'nullable',
            '4_start' => 'nullable',
            '4_end' => 'nullable',
            '5_start' => 'nullable',
            '5_end' => 'nullable',
            '6_start' => 'nullable',
            '6_end' => 'nullable',
            '7_start' => 'nullable',
            '7_end' => 'nullable',
            'delete_image.*' => 'nullable'
        ];
    }
}
