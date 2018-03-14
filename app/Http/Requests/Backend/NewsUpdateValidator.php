<?php

namespace ActivismeBe\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'publish_date' => 'required|date|date_format:Y-m-d',
            'is_published' => 'required',
            'title'        => 'required|max:255',
            'message'      => 'required',
        ];
    }
}
