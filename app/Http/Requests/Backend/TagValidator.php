<?php

namespace ActivismeBe\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validatie class voor de nieuwsberichten categorieen
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \ActivismeBe\Http\Requests\Backend
 */
class TagValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'        => 'string|max:190|required',
            'description' => 'string|required'
        ];
    }
}
