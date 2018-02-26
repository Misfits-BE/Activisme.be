<?php

namespace ActivismeBe\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewsLetterValidator
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     ActivismeBe\Http\Requests\Frontend
 */
class NewsLetterValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ['email' => 'max:120|unique:newsletters|required'];
    }

    /**
     * {@inheritdoc}
     */
    public function messages(): array
    {
        return ['email' => 'E-mail adres is vereist.'];
    }
}
