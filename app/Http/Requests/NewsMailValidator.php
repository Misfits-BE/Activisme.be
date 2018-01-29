<?php

namespace ActivismeBe\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewsMailValidator
 *
 * @author      Tim Joosten <tim@actvisme.be>
 * @copyright   2018 Tim Joosten
 * @package ActivismeBe\Http\Requests
 */
class NewsMailValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'titel'     => 'string|required|max:255',
            'content'   => 'string|required',
            'is_send'   => 'required',
            'status'    => 'required|string'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function messages(): array
    {
        return ['is_send' => 'U moet aangeven of u het bericht wilt verzenden of niet.'];
    }
}
