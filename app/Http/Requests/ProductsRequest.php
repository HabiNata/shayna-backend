<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'name'          =>  ['required', 'max:50'],
            'type'          =>  ['required', 'max:25'],
            'description'   =>  ['required'],
            'price'         =>  ['required', 'numeric', 'digits_between:1,11'],
            'quantity'      =>  ['required', 'numeric', 'digits_between:1,11'],
        ];
    }
}
