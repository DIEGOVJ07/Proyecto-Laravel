<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('judges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('specialty'); // Especialidad: Algoritmos, Estructuras de Datos, etc.
            $table->string('institution')->nullable(); // Universidad o empresa
            $table->integer('experience_years')->default(0);
            $table->text('bio')->nullable();
            $table->string('certification_level'); // Junior, Senior, Expert
            $table->boolean('is_active')->default(true);
            $table->string('photo_url')->nullable();
            $table->timestamps();
        });

        // Tabla pivote para asignar jueces a concursos
        Schema::create('contest_judge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_id')->constrained()->onDelete('cascade');
            $table->foreignId('judge_id')->constrained()->onDelete('cascade');
            $table->string('role')->default('Evaluador'); // Evaluador Principal, Evaluador Secundario, etc.
            $table->timestamps();

            $table->unique(['contest_id', 'judge_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contest_judge');
        Schema::dropIfExists('judges');
    }
};