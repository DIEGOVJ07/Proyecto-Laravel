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
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['Activo', 'Próximamente', 'Finalizado']);
            $table->enum('difficulty', ['Fácil', 'Medio', 'Difícil']);
            $table->dateTime('start_date');
            $table->string('duration'); 
            $table->integer('participants_count')->default(0);
            $table->string('prize')->nullable(); 
            $table->json('tech_stack'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contests');
    }
};
