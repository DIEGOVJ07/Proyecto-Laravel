<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_registration_id')->constrained()->onDelete('cascade'); // ID del equipo
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID del usuario
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('accepted'); // Estado
            $table->timestamps();

            $table->unique(['contest_registration_id', 'user_id']); // Un usuario solo puede estar una vez en un equipo
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};