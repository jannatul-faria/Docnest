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
        Schema::table('chambers', function (Blueprint $table) {
            if (!Schema::hasColumn('chambers', 'division_id')) {
                $table->foreignId('division_id')->nullable()->after('doctor_id')->constrained()->onDelete('set null');
            }
            if (!Schema::hasColumn('chambers', 'district_id')) {
                $table->foreignId('district_id')->nullable()->after('division_id')->constrained()->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chambers', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
            $table->dropForeign(['district_id']);
            $table->dropColumn(['division_id', 'district_id']);
        });
    }
};
