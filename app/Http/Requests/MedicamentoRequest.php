<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Framework\Constraint\IsTrue;

class MedicamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'lote' => 'required',
            'data_validade' => 'required',
            'data_fabricacao' => 'required',
            'valor' => 'required',
            'quantidade' => 'required',

            'laboratorios_id' => 'required|exists:laboratorios,id',
            'transportadoras_id' => 'required|exists:transportadoras,id',

          ];
    }
}
