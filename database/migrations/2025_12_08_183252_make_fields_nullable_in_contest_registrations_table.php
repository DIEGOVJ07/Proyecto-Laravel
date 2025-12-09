<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('contest_registrations', function (Blueprint $table) {
        // Hacemos que estos campos antiguos sean opcionales
        $table->text('team_members')->nullable()->change();
        $table->string('leader_phone')->nullable()->change(); // Agrego este porque seguro será el siguiente error
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contest_registrations', function (Blueprint $table) {
            //
        });
    }
};
