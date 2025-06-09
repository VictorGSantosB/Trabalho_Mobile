<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'categoria_id',
        'quantidade',
        'valor',
        'validade',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
