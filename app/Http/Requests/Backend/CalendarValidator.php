<?php

namespace ActivismeBe\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CalendarValidator extends FormRequest
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
            'name'       => 'required|max:191',
            'status'     => 'required|max:10',
            'start_date' => 'required|date|date_format:Y-m-d', 
            'start_time' => 'required',
            'end_time'   => 'required',
        ];
    }
}
