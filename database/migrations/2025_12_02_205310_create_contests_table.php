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
            $table->integer('participants')->default(0);
            $table->decimal('prize', 10, 2);
            $table->json('languages'); // Array de lenguajes
            $table->date('start_date');
            $table->date('end_date');
            $table->text('rules')->nullable();
            $table->text('requirements')->nullable();
            $table->integer('min_team_members')->default(1);
            $table->integer('max_team_members')->default(5);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contests');
    }
};