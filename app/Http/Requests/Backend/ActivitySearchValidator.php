<?php

namespace ActivismeBe\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ActivitySearchValidator extends FormRequest
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
        return ['term' => 'max:120|required'];
    }
}
