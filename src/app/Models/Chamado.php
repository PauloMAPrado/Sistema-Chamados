<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = ['titulo', 'descricao', 'prioridade', 'status', 'data_abertura', 'tecnico_id', 'categoria_id'];

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
