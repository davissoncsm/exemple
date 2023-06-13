<?php

namespace App\Http\Requests;

use App\Rules\ValidadeCnsRule;
use App\Rules\ValidadeCpfRule;
use Illuminate\Foundation\Http\FormRequest;

class PatientRequestValidator extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'pacient' => 'required|array',
            'pacient.name' => 'required|string|max:255',
            'pacient.cpf' => ['required', new ValidadeCpfRule()],
            'pacient.cns' => ['required', new ValidadeCnsRule()],
            'pacient.motherName' => 'required|string|max:255',
            'pacient.birthdate' => 'required|date_format:Y-m-d|before:today',
            'pacient.photo' => 'sometimes|mimes:jpg,bmp,png',
            'address' => 'required|array',
            'address.street' => 'required|string|max:255',
            'address.number' => 'required|string|max:255',
            'address.neighborhood' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.state' => 'required|string|max:255',
            'address.cep' => 'required|digits:8',
            'address.complement' => 'nullable',
        ];
    }
}
