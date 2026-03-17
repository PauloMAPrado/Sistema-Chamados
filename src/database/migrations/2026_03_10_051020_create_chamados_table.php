<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('prioridade', ['baixa', 'média', 'alta']);
            $table->enum('status', ['aberto', 'em_atendimento', 'resolvido', 'fechado'])->default('aberto');
            $table->date('data_abertura');
            
            $table->foreignId('tecnico_id')->constrained('tecnicos')->restrictOnDelete();
            $table->foreignId('categoria_id')->constrained('categorias')->restrictOnDelete();

            $table->timestamps();

        
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
