<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('status'); // Activo, Próximamente, Finalizado
            $table->string('difficulty'); // Fácil, Medio, Difícil
            $table->string('duration');
            $table->decimal('prize', 10, 2); // Decimal para manejar dinero correctamente
            
            // --- CAMPOS NUEVOS NECESARIOS PARA TU SEEDER ---
            $table->json('languages')->nullable(); // Para el array ['Python', 'Java']
            $table->date('start_date');
            $table->date('end_date');
            $table->text('rules')->nullable();
            $table->text('requirements')->nullable();
            
            // Configuración de equipos
            $table->integer('min_team_members')->default(1);
            $table->integer('max_team_members')->default(3);
            
            // Columna 'participants':
            // La incluyo porque la tienes en tu Seeder ('participants' => 1247).
            // (Aunque lo ideal es calcularla real, ponerla aquí evita que tu seeder falle).
            $table->integer('participants')->default(0); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contests');
    }
};