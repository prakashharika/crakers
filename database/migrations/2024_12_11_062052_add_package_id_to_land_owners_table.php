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
        Schema::table('land_owners', function (Blueprint $table) {
            // Add the 'package_id' column
            $table->unsignedBigInteger('package_id')->nullable();

            // Add foreign key constraint
            $table->foreign('package_id')
                  ->references('id')
                  ->on('packages')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('land_owners', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['package_id']);
            $table->dropColumn('package_id');
        });
    }
};
