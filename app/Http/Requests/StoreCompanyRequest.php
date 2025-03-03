<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>'required|string|max:255',
            'email' => 'nullable|email|',
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Il nome dell\'azienda è obbligatorio.',
            'email.email' => 'Inserisci un indirizzo email valido.',
            'logo.image' => 'Il logo deve essere un\'immagine.',
            'logo.dimensions' => 'Il logo deve avere una dimensione minima di 100x100 pixel.',
            'website.url' => 'Il sito web deve essere un URL valido.',
        ];
    }
}
