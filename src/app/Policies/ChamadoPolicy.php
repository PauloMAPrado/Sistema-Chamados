<?php

namespace App\Policies;

use App\Models\Chamado;
use App\Models\User;

class ChamadoPolicy
{
    public function create(User $user)
    {
        return (bool) $user;
    }

    public function update(User $user, Chamado $chamado)
    {
        if (in_array($user->role ?? 'user', ['tecnico', 'admin'])) {
            return true;
        }

        return ($user->id === $chamado->user_id) && $chamado->status === 'aberto';
    }

    public function resolve(User $user, Chamado $chamado)
    {
        return in_array($user->role ?? 'user', ['tecnico', 'admin']);
    }

    public function attend(User $user, Chamado $chamado)
    {
        return in_array($user->role ?? 'user', ['tecnico', 'admin']);
    }

    public function close(User $user, Chamado $chamado)
    {
        if ($chamado->status !== 'resolvido') {
            return false;
        }

        return in_array($user->role ?? 'user', ['tecnico', 'admin']);
    }
}
