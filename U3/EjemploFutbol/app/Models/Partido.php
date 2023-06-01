<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Partido extends Model
{
    use HasFactory;
    protected $table = 'partidos';
    public $timestamps = false;

    //obtener lista de equipos que juegan un partido
    public function equipos():BelongsToMany{
        return $this->belongsToMany(Equipo::class);
    }

    //obtener lista de equipos que juegan un partido
    //con datos de tabla de intersección
    public function equiposConPivot():BelongsToMany{
        return $this->belongsToMany(Equipo::class)->withPivot(['es_local','goles']);
    }
}
