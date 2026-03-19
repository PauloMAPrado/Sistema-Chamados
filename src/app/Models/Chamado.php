<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Chamado extends Model
{
    protected $fillable = ['titulo', 'descricao', 'prioridade', 'status', 'data_abertura', 'tecnico_id', 'categoria_id', 'user_id', 'resolvido_por_id', 'fechado_por_id'];

    public const PRIORIDADE_ALTA = 'alta';
    public const PRIORIDADE_MEDIA = 'média';
    public const PRIORIDADE_BAIXA = 'baixa';

    public const PRIORIDADES = [
        self::PRIORIDADE_BAIXA,
        self::PRIORIDADE_MEDIA,
        self::PRIORIDADE_ALTA,
    ];

    public const STATUS_ABERTO = 'aberto';
    public const STATUS_EM_ATENDIMENTO = 'em_atendimento';
    public const STATUS_RESOLVIDO = 'resolvido';
    public const STATUS_FECHADO = 'fechado';

    public const STATUSES = [
        self::STATUS_ABERTO,
        self::STATUS_EM_ATENDIMENTO,
        self::STATUS_RESOLVIDO,
        self::STATUS_FECHADO,
    ];

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function resolvidoBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'resolvido_por_id');
    }

    public function fechadoBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'fechado_por_id');
    }

    public function isAtrasado()
    {
        if (! $this->categoria || ! $this->data_abertura) {
            return false;
        }

        $abertura = Carbon::parse($this->data_abertura);
    $prazo = (int) ($this->categoria->horas ?? 0);
        if ($prazo <= 0) {
            return false;
        }

        $due = $abertura->copy()->addHours($prazo);

        return $this->status !== self::STATUS_FECHADO && Carbon::now()->greaterThan($due);
    }

    public function scopeOrderByPrioridade($query)
    {
    return $query->orderByRaw("CASE prioridade WHEN 'alta' THEN 1 WHEN 'média' THEN 2 WHEN 'baixa' THEN 3 ELSE 4 END");
    }
}
