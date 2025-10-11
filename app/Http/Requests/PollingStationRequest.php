<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PollingStationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<int, string>|string>
     */
    public function rules(): array
    {
        return [
            'region_id' => ['integer'],
            'stage_number' => ['integer'],
            'number_of_voters' => ['integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'region_id' => 'Укажите регион.',
            'stage_number' => 'Укажите номер участка.',
            'number_of_voters' => 'Укажите число избирателей.',
        ];
    }
}
