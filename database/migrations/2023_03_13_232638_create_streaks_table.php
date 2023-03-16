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
        Schema::create('streaks', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->integer('total_questions')->default(0);
            $table->integer('score')->default(0);
            $table->integer('question_count')->default(0);
            $table->integer('question_count_max')->default(0);
            // $table->integer('current_question')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streaks_tabke');
    }
};
