<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // NOTA: Aquí usamos 'contest_registrations' que es el nombre real de tu tabla
        Schema::table('contest_registrations', function (Blueprint $table) {
            // Agregamos los campos de puntuación si no existen
            if (!Schema::hasColumn('contest_registrations', 'score')) {
                $table->integer('score')->default(0)->after('status');
            }
            if (!Schema::hasColumn('contest_registrations', 'score_details')) {
                $table->json('score_details')->nullable()->after('score');
            }
            if (!Schema::hasColumn('contest_registrations', 'feedback')) {
                $table->text('feedback')->nullable()->after('score_details');
            }
            
            // Asegurarnos de que el status soporte 'qualified'/'disqualified'
            // Si tu columna status es un string normal, no necesitas hacer nada extra aquí.
        });
    }

    public function down()
    {
        Schema::table('contest_registrations', function (Blueprint $table) {
            $table->dropColumn(['score', 'score_details', 'feedback']);
        });
    }
};