<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'vendor_id' => 'required|numeric',
            'line_items' => 'required|array',
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
