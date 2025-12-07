<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contest_registrations', function (Blueprint $table) {
            $table->string('team_code', 5)->unique()->after('team_name'); // Código único de 5 dígitos
            $table->boolean('is_public')->default(false)->after('team_code'); // Equipo público o privado
            $table->integer('max_members')->default(5)->after('is_public'); // Máximo de miembros
            $table->integer('current_members')->default(1)->after('max_members'); // Miembros actuales
            $table->foreignId('team_leader_id')->nullable()->after('user_id')->constrained('users')->onDelete('cascade'); // Líder del equipo
            $table->boolean('is_team_leader')->default(true)->after('team_leader_id'); // Si es líder del equipo
        });
    }

    public function down(): void
    {
        Schema::table('contest_registrations', function (Blueprint $table) {
            $table->dropColumn(['team_code', 'is_public', 'max_members', 'current_members', 'team_leader_id', 'is_team_leader']);
        });
    }
};