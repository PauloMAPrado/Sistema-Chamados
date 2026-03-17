<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Se a coluna antiga 'sla_horas' existir, crie 'horas', copie os dados e remova 'sla_horas'
        if (Schema::hasTable('categorias') && Schema::hasColumn('categorias', 'sla_horas')) {
            Schema::table('categorias', function (Blueprint $table) {
                $table->integer('horas')->nullable()->after('nome');
            });

            DB::table('categorias')->update(['horas' => DB::raw('sla_horas')]);

            Schema::table('categorias', function (Blueprint $table) {
                $table->dropColumn('sla_horas');
            });
        }
    }

    public function down(): void
    {
        // Reverte: recria 'sla_horas' e copia os dados de volta, removendo 'horas'
        if (Schema::hasTable('categorias') && Schema::hasColumn('categorias', 'horas')) {
            Schema::table('categorias', function (Blueprint $table) {
                $table->integer('sla_horas')->nullable()->after('nome');
            });

            DB::table('categorias')->update(['sla_horas' => DB::raw('horas')]);

            Schema::table('categorias', function (Blueprint $table) {
                $table->dropColumn('horas');
            });
        }
    }
};
