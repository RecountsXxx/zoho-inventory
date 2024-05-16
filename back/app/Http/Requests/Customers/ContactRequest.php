<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'contact_name' => 'required|string|max:200',
            'contact_type' => 'required|string',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'status' => 'error',
                'message' => $validator->errors()->first(),
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
