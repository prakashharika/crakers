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
          Schema::table('general_details', function (Blueprint $table) {
            $table->text('description')->nullable()->after('phone'); // Adjust 'phone' to whichever column you want it after
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_details', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
