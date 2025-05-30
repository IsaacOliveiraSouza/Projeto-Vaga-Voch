<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bandeira extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'nome',
        'grupo_economico_id'
    ];

    public function grupoEconomico()
    {
        return $this->belongsTo(GrupoEconomico::class);
    }

    public function Unidades()
    {
        return $this->belongsTo(Unidade::class);
    }
}
