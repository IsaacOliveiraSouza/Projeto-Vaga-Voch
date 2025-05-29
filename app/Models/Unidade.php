<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unidade extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'nome_fantasia',
        'razao_social',
        'cnpj',
        'bandeira_id'
    ];
    
    public function bandeira(){
        return $this->hasMany(Bandeira::class);
    }


    public function colaboradores(){
        return $this->belongsTo(Colaborador::class);
    }
}
