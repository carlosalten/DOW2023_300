<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JugadoresRequest extends FormRequest
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
            'rut' => ['required','min:9','max:10',Rule::unique('jugadores')->ignore(request('jugador'))],
            'nombre' => 'required|alpha|min:2|max:30',
            'apellido' => 'required|alpha|min:2|max:30',
            'numero_camiseta' => 'bail|required|integer|gte:1|lte:99',
            'posicion' => ['required',Rule::in(['Arquero','Defensa','Volante','Delantero'])],
            'equipo' => 'bail|required|integer|gte:1|exists:equipos,id',
        ];
    }

    public function messages():array
    {
        return [
            'rut.required' => 'Indique el RUT',
            'rut.min' => 'RUT no válido',
            'rut.max' => 'RUT no válido',
            'rut.unique' => 'El RUT ya está ocupado por otro jugador',
            'nombre.required' => 'Indique el Nombre',
            'nombre.alpha' => 'Nombre debe tener solo letras',
            'nombre.min' => 'Nombre debe tener mínimo 2 letras',
            'nombre.max' => 'Nombre debe tener máximo 30 letras',
            'apellido.required' => 'Indique el Apellido',
            'apellido.alpha' => 'Apellido debe tener solo letras',
            'apellido.min' => 'Apellido debe tener mínimo 2 letras',
            'apellido.max' => 'Apellido debe tener máximo 30 letras',
            'numero_camiseta.required' => 'Indique el Número de Camiseta',
            'numero_camiseta.integer' => 'El Número de Camiseta debe ser un número entero',
            'numero_camiseta.gte' => 'El Número de Camiseta debe ser 1 o mayor',
            'numero_camiseta.lte' => 'El Número de Camista debe ser 99 o menor',
            'posicion.required' => 'Indique la posición en el campo',
            'posicion.in' => 'La Posición no es válida',
            'equipo.required' => 'Indique el Equipo del jugador',
            'equipo.integer' => 'Equipo no válido',
            'equipo.gte' => 'Equipo no válido',
            'equipo.exists' => 'Equipo no válido',
        ];
    }
}
