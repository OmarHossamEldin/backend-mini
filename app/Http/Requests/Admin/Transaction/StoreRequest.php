<?php

namespace App\Http\Requests\Admin\Transaction;

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
            'category_id' => 'required|exists:App\Models\Category,id',
            'subcategory_id'=> 'nullable|exists:App\Models\Category,id',
            'amount' => 'required|numeric',
            'customer_id' => 'required|exists:App\Models\User,id',
            'due_on' => 'required|date',
            'vat' => 'required|numeric',
            'is_vat_inclusive' => 'required|numeric',
            'status' => 'required|in:paid,outstanding,overdue'
        ];
    }
}
