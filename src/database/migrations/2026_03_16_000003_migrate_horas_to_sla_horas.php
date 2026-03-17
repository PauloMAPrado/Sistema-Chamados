<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
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

    public function down(): void
    {
        if (Schema::hasTable('categorias') && ! Schema::hasColumn('categorias', 'horas')) {
            Schema::table('categorias', function (Blueprint $table) {
                $table->integer('horas')->nullable()->after('nome');
            });

            DB::table('categorias')->update(['horas' => DB::raw('sla_horas')]);

            Schema::table('categorias', function (Blueprint $table) {
                $table->dropColumn('sla_horas');
            });
        }
    }
};
