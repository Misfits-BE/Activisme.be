<?php

namespace ActivismeBe\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class NewsLetterValidator extends FormRequest
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
        return ['email' => 'max:120|unique:newsletters|required'];
    }
}
