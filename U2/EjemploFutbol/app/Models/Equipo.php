<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'equipos';

    //obtiene todos los jugadores de un equipo
    public function jugadores():HasMany{
        return $this->hasMany(Jugador::class);
    }

    //obtener los partidos en que participa el equipo
    public function partidos():BelongsToMany{
        return $this->belongsToMany(Partido::class);
    }

    //obtener los partidos en que participa el equipo
    //incluyendo campos de tabla de intersección
    public function partidosConPivot():BelongsToMany{
        return $this->belongsToMany(Partido::class)->withPivot(['es_local','goles']);
    }
}
