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
        Schema::table('contest_registrations', function (Blueprint $table) {
            $table->string('project_file')->nullable()->after('status'); // Ruta del archivo del proyecto
            $table->string('github_link')->nullable()->after('project_file'); // Enlace de GitHub
            $table->timestamp('file_uploaded_at')->nullable()->after('github_link'); // Fecha de subida del archivo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contest_registrations', function (Blueprint $table) {
            $table->dropColumn(['project_file', 'github_link', 'file_uploaded_at']);
        });
    }
};
