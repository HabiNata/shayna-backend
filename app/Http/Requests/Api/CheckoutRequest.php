<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name'                      =>  ['required', 'max:255'],
            'email'                     =>  ['required', 'max:255', 'email'],
            'number'                    =>  ['required', 'string', 'digits_between:5,12'],
            'address'                   =>  ['required'],
            'transaction_total'         =>  ['integer','required'],
            'transaction_status'        =>  ['nullable', 'in:PENDING,SUCCESS,FAILED', 'string'],
            'transaction_details'       =>  ['array', 'required'],
            'transaction_details.*'     =>  ['exists:products,id', 'integer']
        ];
    }
}
