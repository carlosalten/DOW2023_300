<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Jugador;

class NumeroCamisetaRepetidoRule implements ValidationRule
{
    public $equipoId;

    public function __construct($equipoId){
        $this->equipoId = $equipoId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $numeroCamiseta = $value;
        $equipoId = $this->equipoId;

        $result = Jugador::where('numero_camiseta',$numeroCamiseta)->where('equipo_id',$equipoId)->get();

        if(!$result->isEmpty()){
            $jugador = $result->first();
            $fail('En '.$jugador->equipo->nombre.' la camiseta '.$numeroCamiseta.' ya está asignada '.$jugador->nombre.' '.$jugador->apellido);
            // $fail('La camiseta '.$numeroCamiseta.' ya está asignada '.$jugador->nombre.' '.$jugador->apellido);
            // $fail('La camiseta '.$numeroCamiseta.' ya está asignada');
            // $fail('El número de camiseta ya está asignado');
        }

        // dd($equipoId);
        // dd($numeroCamiseta);

        
    }
}
