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
        Schema::create('leaders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country', 2);
            $table->integer('points');
            $table->integer('wins');
            $table->integer('solved');
            $table->enum('trend', ['up', 'down', 'flat']);
            $table->string('initial', 1);
            $table->string('color', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaders');
    }
};
