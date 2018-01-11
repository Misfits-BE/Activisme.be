<?php

namespace ActivismeBe\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ContactsValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'naam'        => 'required|string|max:120', 
            'email'       => 'required|string|max:120', 
            'telefoon_nr' => 'required|string|max:20', 
            'organisatie' => 'required|string|max:200', 
        ];
    }
}
