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
        Schema::create('chamber_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chamber_id')->constrained()->onDelete('cascade');
            $table->string('day'); // Saturday, Sunday, etc.
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_patients')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamber_schedules');
    }
};
