<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string'
            ],
            'last_name' => [
                'required',
                'string'
            ],
            'gender' => [
                'required',
                'string'
            ],
            'date_of_birth' => [
                'required',
            ],
            'email' => [
                'required',
                'string'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'phone' => [
                'required',
                'string',
                'digits:11'
            ],
            'address' => [
                'required',
                'string'
            ],
            'city' => [
                'required',
                'string'
            ],
            'state' => [
                'required',
                'string'
            ],
            'postal_code' => [
                'required',
                'string',
                'digits:4'
            ],
            'country' => [
                'required',
                'string'
            ],
            'profile_image' => [
                'nullable',
                'mimes:jpg,jpeg,png'
            ],
            'admin_comment' => [
                'nullable'
            ],
            'is_active' => [
                'nullable'
            ],
            'created_by' => [
                'nullable'
            ],
            'updated_by' => [
                'nullable'
            ],
            'role_as' => [
                'required'
            ],
        ];
    }
}
