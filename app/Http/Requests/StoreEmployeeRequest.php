<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Il nome è obbligatorio.',
            'last_name.required' => 'Il cognome è obbligatorio.',
            'company_id.required' => 'L\'azienda è obbligatoria.',
            'company_id.exists' => 'L\'azienda selezionata non esiste.',
            'email.email' => 'Inserisci un indirizzo email valido.',
        ];
    }
}
