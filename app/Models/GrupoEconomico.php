<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;


class GrupoEconomico extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'nome'
    ];
    
    public function bandeiras(){
        return $this->belongsTo(Bandeira::class);
    }
}
