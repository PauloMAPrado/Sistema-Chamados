<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            // quem criou o chamado
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
            // auditoria: quem resolveu e quem fechou
            $table->foreignId('resolvido_por_id')->nullable()->constrained('users')->nullOnDelete()->after('tecnico_id');
            $table->foreignId('fechado_por_id')->nullable()->constrained('users')->nullOnDelete()->after('resolvido_por_id');
        });
    }

    public function down(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->dropForeign(['fechado_por_id']);
            $table->dropForeign(['resolvido_por_id']);
            $table->dropForeign(['user_id']);

            $table->dropColumn(['fechado_por_id', 'resolvido_por_id', 'user_id']);
        });
    }
};
