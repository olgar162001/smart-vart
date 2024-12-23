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
        Schema::table('totals', function (Blueprint $table) {
            $table->string('Month')->after('total_vat_difference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('totals', function (Blueprint $table) {
            $table->removeColumn('Month');
        });
    }
};
