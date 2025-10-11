<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'region_id' => ['required', 'integer', 'exists:regions,id'],
            'stage_number' => ['required', 'integer', 'min:1',
                Rule::unique('polling_stations')->where(function ($query) {
                    return $query->where('region_id', $this->input('region_id'));
                }), ],
            'number_of_voters' => ['required', 'integer', 'min:0'],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'region_id.required' => 'Укажите регион.',
            'region_id.integer' => 'ID региона должен быть числом.',
            'region_id.exists' => 'Выбранный регион не существует.',
            'stage_number.required' => 'Укажите номер участка.',
            'stage_number.integer' => 'Номер участка должен быть числом.',
            'stage_number.min' => 'Номер участка должен быть больше 0.',
            'stage_number.unique' => 'Участок с таким номером уже существует в этом регионе.',
            'number_of_voters.required' => 'Укажите число избирателей.',
            'number_of_voters.integer' => 'Число избирателей должно быть числом.',
            'number_of_voters.min' => 'Число избирателей не может быть отрицательным.',
        ];
    }
}
