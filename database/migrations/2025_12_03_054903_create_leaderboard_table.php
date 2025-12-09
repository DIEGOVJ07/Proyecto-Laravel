<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderboard', function (Blueprint $table) {
            $table->id();
            
            // Relaciones
            $table->foreignId('contest_id')->constrained('contests')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // --- CORRECCIÓN PRINCIPAL ---
            // Cambiamos 'total_points' por 'points' para que coincida con tu código
            $table->integer('points')->default(0);
            
            // Cambiamos 'global_ranking' por 'rank' (es el ranking de ESTE concurso, no el global)
            $table->integer('rank')->nullable();
            
            $table->integer('problems_solved')->default(0);
            
            // Nota: Eliminé 'contests_won' porque esta tabla es el resultado de UN solo concurso.
            // Si quieres saber cuántos ha ganado, se calcula contando cuántas veces quedó en rank #1.
            
            $table->string('country_code', 2)->default('MX');
            $table->string('trend')->default('stable'); // up, down, stable
            
            $table->timestamps();

            // Índices para optimizar la velocidad
            $table->index(['contest_id', 'points']); // Para ordenar rápido el leaderboard
            
            // Regla de oro: Un usuario no puede tener 2 puntajes en el mismo concurso
            $table->unique(['contest_id', 'user_id']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderboard');
    }
};