<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('prioridade', ['baixa', 'média', 'alta']);
            $table->enum('status', ['aberto', 'em andamento', 'fechado'])->default('aberto');
            $table->date('data_abertura');
            


            // Relacionamentos com RESTRICT - impede exclusão de pais com filhos
            // o cascade exclui o pai
            $table->foreignId('tecnico_id')->constrained('tecnicos')->restrictOnDelete();
            $table->foreignId('categoria_id')->constrained('categorias')->restrictOnDelete();

            $table->timestamps();

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
