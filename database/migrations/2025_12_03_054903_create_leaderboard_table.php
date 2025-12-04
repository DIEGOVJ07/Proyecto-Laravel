<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderboard', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('total_points')->default(0);
            $table->integer('contests_won')->default(0);
            $table->integer('problems_solved')->default(0);
            $table->integer('global_ranking')->nullable();
            $table->string('country_code', 2)->default('MX');
            $table->string('trend')->default('stable'); // up, down, stable
            $table->timestamps();

            $table->index('total_points');
            $table->index('global_ranking');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderboard');
    }
};