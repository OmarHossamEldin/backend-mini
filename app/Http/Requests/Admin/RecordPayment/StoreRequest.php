<?php

namespace App\Http\Requests\Admin\RecordPayment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'transaction_id' => 'required|exists:App\Models\Transaction,id',
            'amount' => 'required|numeric',
            'paid_on' => 'required|date',
            'details' => 'nullable'
        ];
    }
}
