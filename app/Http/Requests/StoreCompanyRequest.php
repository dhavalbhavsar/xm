<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentDateAfterOrEqual;
use App\Rules\CurrentDateBeforeOrEqual;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_symbol' => 'required|exists:companies,id',
            'start_date' => ['required', new CurrentDateAfterOrEqual('end_date')],
            'end_date' => ['required', new CurrentDateBeforeOrEqual('start_date')],
            'email' => 'required|email'
        ];
    }
}
