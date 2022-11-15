<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:posts|max:200',
            'name'  => 'required',
            'no_telp'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'An Email is required',
            'email.unique'      => 'The Email has already been taken. Try another title.',
            'name.required'     => 'Name is required',
            'no_telp.required'     => 'Phone Number is required'
        ];
    }
}
