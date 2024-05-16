<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

class TaxRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tax_name' => 'required|string|max:200',
            'tax_percentage' => 'required|numeric|min:0|max:100',
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
